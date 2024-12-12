<?php

namespace App\Services\Shopify;

class ShopifyOrderMapper
{
    /**
     * Map Shopify order to local order format.
     *
     * @param array $shopifyOrder
     * @return array
     */
    public function map(array $shopifyOrder): array
    {
        return [
            'external_order_id' => $shopifyOrder['id'] ?? null,
            'source' => 'Shopify',
            'customer_name' => $this->getCustomerName($shopifyOrder),
            'customer_email' => $shopifyOrder['email'] ?? null,
            'total_amount' => $shopifyOrder['total_price'] ?? 0.00,
            'status' => $shopifyOrder['financial_status'] ?? 'unknown',
            'placed_at' => $shopifyOrder['created_at'] ?? now(),
        ];
    }

    /**
     * Safely retrieve the customer's full name.
     *
     * @param array $shopifyOrder
     * @return string|null
     */
    private function getCustomerName(array $shopifyOrder): ?string
    {
        $customer = $shopifyOrder['customer'] ?? null;

        if (!$customer) {
            return null;
        }

        $firstName = $customer['first_name'] ?? '';
        $lastName = $customer['last_name'] ?? '';

        return trim("{$firstName} {$lastName}") ?: null;
    }
}
