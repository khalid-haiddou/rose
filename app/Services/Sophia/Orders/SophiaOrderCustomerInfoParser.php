<?php

declare(strict_types=1);

namespace App\Services\Sophia\Orders;

/**
 * Parses a WhatsApp message into candidate customer fields.
 *
 * A greeting-only line is still returned as an address candidate. Callers must
 * reject it with SophiaOrderCustomerFieldValidator before storing it.
 */
class SophiaOrderCustomerInfoParser
{
    public function __construct(
        private readonly SophiaOrderCustomerFieldValidator $customerFieldValidator,
    ) {}

    /**
     * @return array{address?: string, city?: string}
     */
    public function splitAddressAndCity(string $line): array
    {
        $line = trim($line);
        if ($line === '') {
            return [];
        }

        if (str_contains($line, ',')) {
            $parts = array_values(array_filter(array_map('trim', explode(',', $line)), static fn (string $part): bool => $part !== ''));
            if (count($parts) >= 2) {
                $city = array_pop($parts);
                $address = trim(implode(', ', $parts));
                if ($address !== '' && $city !== null && $this->customerFieldValidator->isKnownCity($city)) {
                    return [
                        'address' => $address,
                        'city' => $city,
                    ];
                }
            }
        }

        if ($this->customerFieldValidator->isKnownCity($line)) {
            return ['city' => $line];
        }

        return ['address' => $line];
    }

    /**
     * @return array<string, string>
     */
    public function parse(string $message): array
    {
        $message = trim($message);
        if ($message === '') {
            return [];
        }

        $fields = [];
        $addressParts = [];

        foreach (preg_split('/\R/u', $message) ?: [] as $rawLine) {
            $line = trim($rawLine);
            if ($line === '') {
                continue;
            }

            if (preg_match('/^(?:adresse|address)\s*[:\-]\s*(.+)$/iu', $line, $matches)) {
                $addressParts[] = trim($matches[1]);

                continue;
            }

            if (preg_match('/^(?:ville|city)\s*[:\-]\s*(.+)$/iu', $line, $matches)) {
                $fields['city'] = trim($matches[1]);

                continue;
            }

            if (preg_match('/^(?:nom|name)\s*[:\-]\s*(.+)$/iu', $line, $matches)) {
                $fields['name'] = trim($matches[1]);

                continue;
            }

            if (preg_match('/^(?:t[eé]l(?:[eé]phone)?|phone|gsm)\s*[:\-]\s*(.+)$/iu', $line, $matches)) {
                $fields['phone'] = trim($matches[1]);

                continue;
            }

            $split = $this->splitAddressAndCity($line);
            if (isset($split['address'])) {
                $addressParts[] = $split['address'];
            }
            if (isset($split['city']) && ! isset($fields['city'])) {
                $fields['city'] = $split['city'];
            }
        }

        if ($addressParts !== []) {
            $fields['address'] = implode(', ', $addressParts);
        }

        return $fields;
    }
}
