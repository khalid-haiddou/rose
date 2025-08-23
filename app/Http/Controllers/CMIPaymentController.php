<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Services\CMI\CmiPaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;

class CMIPaymentController extends Controller
{
    public function __construct(private CmiPaymentService $cmiPaymentService) {}

    /**
     * Redirect to CMI payment gateway
     */
    public function redirectToGateway(Commande $commande)
    {
        try {
            // Store the order ID in session for tracking
            session(['current_order_id' => $commande->id]);

            // Use your existing service to create checkout session
            return $this->cmiPaymentService->createCheckoutSession($commande);

        } catch (\Exception $e) {

            return redirect()->route('checkout')
                ->with('error', 'Erreur lors de la redirection vers le paiement. Veuillez réessayer.');
        }
    }

    /**
     * Handle successful payment page
     */
    public function paymentSuccess(Request $request)
    {
        // Clear any stored checkout data since payment was successful
        session()->forget(['checkout_data', 'current_order_id']);

 
        // Get the order from session or URL parameter
        $orderId = session('current_order_id') ?? $request->get('oid');
        $order = null;

        if ($orderId) {
            $order = Commande::where('order_number', $orderId)->first();
        }

        return redirect()->route('merci')
            ->with('success', 'Commande passée avec succès !')
            ->with('order_number', $order->orderNumber)
            ->with('order_email', $order->email);
    }



    /**
     * Handle payment failure page
     */
    public function paymentFailure(Request $request)
    {

        // Store detailed error information if available
        $errorMessage = 'Le paiement a échoué. Veuillez réessayer avec une autre carte ou méthode de paiement.';

        // Get more specific error from request if available
        if ($request->has('ErrMsg')) {
            $errorMessage = $request->get('ErrMsg');
        } elseif ($request->has('mdErrorMsg')) {
            $errorMessage = $request->get('mdErrorMsg');
        }

        session()->flash('payment_error', $errorMessage);

        // Otherwise redirect to cart
        return redirect()->route('cart.index')
            ->with('error', $errorMessage);
    }

    public function callback(Request $request)
    {
        try {
            $success = $this->cmiPaymentService->processCallback($request->all());

            if ($success) {
                // Payment successful - clear stored checkout data
                session()->forget(['checkout_data', 'current_order_id']);

                $commande = Commande::where('order_number', $request['oid'])->first();
                Mail::to($commande->email)->send(new OrderConfirmation($commande));

                // Return success response to CMI
                return response($this->cmiPaymentService->generateCallbackResponse(true), 200)
                    ->header('Content-Type', 'text/plain');
            } else {
                // Payment failed - keep checkout data for retry
                // The checkout data should already be stored from the redirectToGateway method

                // Return failure response to CMI
                return response('APPROVED', 200) // or whatever your CMI expects for failures
                ->header('Content-Type', 'text/plain');
            }

        } catch (\Exception $e) {

            return response('ERROR', 500)
                ->header('Content-Type', 'text/plain');
        }
    }
}
