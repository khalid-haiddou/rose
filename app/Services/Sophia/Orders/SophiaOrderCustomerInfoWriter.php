<?php

declare(strict_types=1);

namespace App\Services\Sophia\Orders;

interface SophiaOrderCustomerInfoWriter
{
    /**
     * Persist validated customer fields onto the active draft.
     *
     * @param  array<string, string>  $fields
     */
    public function setOrderCustomerInfo(array $fields): void;
}
