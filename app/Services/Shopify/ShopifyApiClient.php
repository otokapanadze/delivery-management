<?php

namespace App\Services\Shopify;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ShopifyApiClient
{
    protected string $accessToken;
    public string $shopDomain;

    public function __construct(string $accessToken, string $shopDomain)
    {
        $this->accessToken = $accessToken;
        $this->shopDomain = $shopDomain;
    }

    /**
     * Fetch orders from Shopify.
     *
     * @return array
     * @throws \Exception
     */
    public function fetchOrders(): array
    {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'X-Shopify-Access-Token' => $this->accessToken,
            ])->get("https://{$this->shopDomain}/admin/api/2024-10/orders.json");

            if ($response->failed()) {
                Log::error('Shopify API call failed', [
                    'shop_domain' => $this->shopDomain,
                    'status' => $response->status(),
                    'error' => $response->body(),
                ]);

                throw new \Exception('Failed to fetch orders from Shopify. See logs for more details.');
            }

            return $response->json()['orders'] ?? [];
        } catch (\Exception $e) {
            Log::critical('An error occurred during Shopify API call', [
                'shop_domain' => $this->shopDomain,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }
}
