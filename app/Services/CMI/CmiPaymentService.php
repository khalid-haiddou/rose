<?php

namespace App\Services\CMI;

use App\Mail\OrderConfirmation;
use App\Models\Commande;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CmiPaymentService
{
    protected $clientId;
    protected $storeKey;
    protected $returnUrl;
    protected $successUrl;
    protected $failureUrl;
    protected $gatewayUrl;
    protected $currencyCode;
    protected $autoRedirect;
    protected $sessionTimeout;

    public function __construct()
    {
        $this->clientId = config('services.cmi.tpe');
        $this->storeKey = config('services.cmi.secret');
        $this->returnUrl = config('services.cmi.return_url');
        $this->successUrl = config('services.cmi.success_url');
        $this->failureUrl = config('services.cmi.failure_url');
        $this->gatewayUrl = config('services.cmi.gateway_url');
        $this->currencyCode = config('services.cmi.currency_code', '504');
        $this->autoRedirect = config('services.cmi.auto_redirect', true);
        $this->sessionTimeout = config('services.cmi.session_timeout', 1800);
    }

    public function createCheckoutSession(Commande $commande)
    {
        $amount = number_format($commande->total, 2, '.', '');
        $orderId = $commande->order_number;

        // Build parameters for CmiClient
        $cmiParams = [
            'storekey'        => $this->storeKey,
            'clientid'        => $this->clientId,
            'oid'             => $orderId,
            'amount'          => $amount,
            'okUrl'           => $this->successUrl,
            'failUrl'         => $this->failureUrl,
            'email'           => $commande->email,
            'BillToName'      => $commande->firstname . ' ' . $commande->lastname,
            'currency'        => $this->currencyCode,
            'lang'            => $commande->lang ?? 'fr',
            'storetype'       => '3D_PAY_HOSTING',
            'trantype'        => 'PreAuth',
            'hashAlgorithm'   => 'ver3',
            'encoding'        => 'UTF-8',
            'refreshtime'     => '5',
            'CallbackURL'     => $this->returnUrl,
            'CallbackResponse'=> 'true',
            'AutoRedirect'    => $this->autoRedirect ? 'true' : 'false',
            'sessiontimeout'  => (string) $this->sessionTimeout,
        ];

        // Create CmiClient instance
        $cmiClient = new CmiClient($cmiParams, $this->gatewayUrl);

        // Redirect to CMI payment page
        $cmiClient->redirect_post();
    }

    /**
     * Process CMI callback and update order status
     *
     * @param array $params Callback parameters from CMI
     * @return bool Success status
     */
    public function processCallback(array $params): bool
    {
        try {

            // Step 2: Extr
            // Step 1: Verify hash integrity
            if (!$this->verifyCallbackHashWithClient($params)) {
                return false;
            }

            // Step 2: Extract order information
            $orderId = $params['oid'] ?? null;
            $procReturnCode = $params['ProcReturnCode'] ?? null;
            $response = $params['Response'] ?? null;
            $transId = $params['TransId'] ?? null;
            $authCode = $params['AuthCode'] ?? null;

            if (!$orderId) {    
                return false;
            }

            // Step 3: Find the order
            $commande = Commande::where('order_number', $orderId)->first();
            if (!$commande) {
                return false;
            }

            // Step 4: Process payment result
            $isPaymentSuccessful = $this->isPaymentSuccessful($procReturnCode, $response);

            // Step 5: Update order based on payment result
            if ($isPaymentSuccessful) {
                return $this->handleSuccessfulPayment($commande, $params, $transId, $authCode);
            } else {
                return $this->handleFailedPayment($commande, $params);
            }

        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Check if payment was successful based on CMI response codes
     */
    protected function isPaymentSuccessful($procReturnCode, $response): bool
    {
        // CMI success codes
        $successCodes = ['00']; // Add other success codes as needed
        $successResponses = ['Approved', 'APPROVED'];

        return in_array($procReturnCode, $successCodes) ||
            in_array($response, $successResponses);
    }

    /**
     * Handle successful payment
     */
    protected function handleSuccessfulPayment(Commande $commande, array $params, $transId, $authCode): bool
    {
        try {
            // Update order status
            $commande->update([
                'is_payed' => true,
                'payment_status' => 'paid',
                'transaction_id' => $transId,
                'auth_code' => $authCode,
                'payment_date' => now(),
                'cmi_response' => json_encode($params)
            ]);


            // Award fidelity points for successful payment
            $this->awardFidelityPoints($commande);

            // Send confirmation email
            try {
                Mail::to($commande->email)->send(new OrderConfirmation($commande));
                
            } catch (\Exception $e) {
               
                // Don't fail the payment processing if email fails
            }

            // Clear cart from session if it exists
            if (session()->has('cart')) {
                session()->forget('cart');
            }

            return true;

        } catch (\Exception $e) {
            
            return false;
        }
    }

    /**
     * Handle failed payment
     */
    protected function handleFailedPayment(Commande $commande, array $params): bool
    {
        try {
            // Update order status
            $commande->update([
                'is_payed' => false,
                'payment_status' => 'failed',
                'cmi_response' => json_encode($params)
            ]);

            // Restore product stock since payment failed
            foreach ($commande->products as $product) {
                $quantity = $product->pivot->quantity;
                $product->increment('stock', $quantity);

                
            }

            // Restore fidelity credit if it was used
            if ($commande->user && $commande->fidelity_used > 0) {
                $commande->user->increment('fidelity_credit', $commande->fidelity_used);

            }


            return true;

        } catch (\Exception $e) {
        
            return false;
        }
    }

    /**
     * Award fidelity points for successful orders
     */
    protected function awardFidelityPoints(Commande $commande): void
    {
        if (!$commande->user) {
            return; // No user, no fidelity points
        }

        // Calculate fidelity points (e.g., 1 point per 10 MAD spent)
        $pointsToAward = floor($commande->total / 10);

        if ($pointsToAward > 0) {
            $commande->user->increment('fidelity_credit', $pointsToAward);

            // Update the order with earned points
            $commande->update(['fidelity_earned' => $pointsToAward]);

        }
    }

    /**
     * Verify hash from CMI callback using CmiClient
     */
    public function verifyCallbackHashWithClient(array $params): bool
    {
         $receivedHash = $params['HASH'] ?? '';
    
        try {
            // 🔥 CLEAN: Prepare parameters and handle null values
            $cmiParams = [];
            
            foreach ($params as $key => $value) {
                $lowerKey = strtolower($key);
                if ($lowerKey !== 'hash' && $lowerKey !== 'encoding') {
                    // 🔥 FIX: Convert null values to empty strings
                    if ($value === null) {
                        $cmiParams[$key] = '';
                    } else {
                        $cmiParams[$key] = (string) $value;
                    }
                }
            }
            // Add storekey
            $cmiParams['storekey'] = $this->storeKey;
        
            
            // Create CmiClient with cleaned parameters
            $cmiClient = new CmiClient($cmiParams);
            $calculatedHash = $cmiClient->generateHash();
            
            $hashMatch = ($calculatedHash === $receivedHash);
            
       
            return $hashMatch;
            
        } catch (\Exception $e) {
      
            return false;
        }
    }

    /**
     * Generate callback response for CMI
     */
    public function generateCallbackResponse(bool $autoCapture): string
    {
        return $autoCapture ? 'ACTION=POSTAUTH' : 'APPROVED';
    }

    /**
     * Keep existing method for backward compatibility
     */
    public function verifyCallbackHash(array $params): bool
    {
        $receivedHash = $params['HASH'] ?? '';
        $calculated = $this->generatePaymentHash(array_diff_key($params, ['HASH' => '', 'encoding' => '']));

        return $receivedHash === $calculated;
    }

    protected function generatePaymentHash(array $params): string
    {
        $filtered = collect($params)
            ->except(['hash', 'encoding'])
            ->sortKeys()
            ->map(fn($value) => str_replace(['\\', '|'], ['\\\\', '\\|'], trim($value)))
            ->implode('|');

        $escapedStoreKey = str_replace(['\\', '|'], ['\\\\', '\\|'], $this->storeKey);
        $hashData = $filtered . '|' . $escapedStoreKey;


        return base64_encode(pack('H*', hash('sha512', $hashData)));
    }
}
