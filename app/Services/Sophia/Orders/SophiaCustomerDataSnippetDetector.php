<?php

declare(strict_types=1);

namespace App\Services\Sophia\Orders;

/**
 * Detects whether a WhatsApp message contains usable customer data.
 *
 * A non-empty parse is not enough: at least one parsed field must pass
 * SophiaOrderCustomerFieldValidator. An address that is only "Bonjour." does not.
 */
class SophiaCustomerDataSnippetDetector
{
    public function __construct(
        private readonly SophiaOrderCustomerInfoParser $parser,
        private readonly SophiaOrderCustomerFieldValidator $customerFieldValidator,
    ) {}

    public function detectsCustomerDataSnippet(string $message): bool
    {
        $parsed = $this->parser->parse($message);
        if ($parsed === []) {
            return false;
        }

        return $this->hasValidParsedCustomerField($parsed);
    }

    /**
     * A parsed greeting such as address="Bonjour." is not a customer-data snippet.
     *
     * @param  array<string, mixed>  $parsed
     */
    private function hasValidParsedCustomerField(array $parsed): bool
    {
        foreach ($parsed as $field => $value) {
            if (! is_string($field) || ! is_string($value)) {
                continue;
            }

            if ($this->customerFieldValidator->passes($field, $value)) {
                return true;
            }
        }

        return false;
    }
}
