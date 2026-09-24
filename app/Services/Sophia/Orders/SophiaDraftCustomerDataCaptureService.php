<?php

declare(strict_types=1);

namespace App\Services\Sophia\Orders;

/**
 * Captures delivery details from a Sophia draft conversation.
 *
 * Greeting-only messages are skipped before set_order_customer_info. An address
 * is stored only when it passes SophiaOrderCustomerFieldValidator::isValidAddress.
 */
class SophiaDraftCustomerDataCaptureService
{
    public function __construct(
        private readonly SophiaOrderCustomerInfoParser $parser,
        private readonly SophiaOrderCustomerFieldValidator $customerFieldValidator,
        private readonly SophiaCustomerDataSnippetDetector $snippetDetector,
        private readonly SophiaOrderCustomerInfoWriter $customerInfoWriter,
    ) {}

    public function shouldSkipMandatoryCapture(string $message): bool
    {
        return $this->customerFieldValidator->isGreetingOrChatFiller($message);
    }

    public function captureMandatoryCustomerData(string $message): void
    {
        if ($this->shouldSkipMandatoryCapture($message)) {
            return;
        }

        if (! $this->snippetDetector->detectsCustomerDataSnippet($message)) {
            return;
        }

        $parsed = $this->parser->parse($message);
        $payload = [];

        if (isset($parsed['name']) && $this->customerFieldValidator->isValidName($parsed['name'])) {
            $payload['name'] = $parsed['name'];
        }

        if (isset($parsed['phone']) && $this->customerFieldValidator->isValidPhone($parsed['phone'])) {
            $payload['phone'] = $parsed['phone'];
        }

        if (isset($parsed['address']) && $this->looksLikeRealAddress($parsed['address'])) {
            $payload['address'] = $parsed['address'];
        }

        if (isset($parsed['city']) && $this->customerFieldValidator->isValidCity($parsed['city'])) {
            $payload['city'] = $parsed['city'];
        }

        if ($payload === []) {
            return;
        }

        $this->customerInfoWriter->setOrderCustomerInfo($payload);
    }

    private function looksLikeRealAddress(?string $address): bool
    {
        return $this->customerFieldValidator->isValidAddress($address);
    }
}
