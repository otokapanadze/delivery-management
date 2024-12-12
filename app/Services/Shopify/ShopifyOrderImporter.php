<?php

namespace App\Services\Shopify;

use App\Models\Order;
use Illuminate\Support\Facades\Log;

class ShopifyOrderImporter
{
    protected ShopifyApiClient $apiClient;
    protected ShopifyOrderMapper $orderMapper;

    public function __construct(ShopifyApiClient $apiClient, ShopifyOrderMapper $orderMapper)
    {
        $this->apiClient = $apiClient;
        $this->orderMapper = $orderMapper;
    }

    /**
     * Import orders from Shopify.
     */
    public function import(): void
    {
        try {
            $orders = $this->apiClient->fetchOrders();

            if (empty($orders)) {
                Log::info('No orders found in Shopify API response', [
                    'shop_domain' => $this->apiClient->shopDomain,
                ]);
                return;
            }

            foreach ($orders as $shopifyOrder) {
                try {
                    $mappedOrder = $this->orderMapper->map($shopifyOrder);

                    Order::updateOrCreate(
                        ['external_order_id' => $mappedOrder['external_order_id']],
                        $mappedOrder
                    );
                } catch (\Exception $e) {
                    Log::error('Failed to store order', [
                        'shop_domain' => $this->apiClient->shopDomain,
                        'order_id' => $shopifyOrder['id'],
                        'error' => $e->getMessage(),
                    ]);
                }
            }
        } catch (\Exception $e) {
            Log::critical('An error occurred during Shopify order import', [
                'shop_domain' => $this->apiClient->shopDomain,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
