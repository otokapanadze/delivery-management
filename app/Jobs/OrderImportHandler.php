<?php

namespace App\Jobs;

use App\Models\Integration;
use App\Services\Shopify\ShopifyApiClient;
use App\Services\Shopify\ShopifyOrderMapper;
use App\Services\Shopify\ShopifyOrderImporter;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class OrderImportHandler implements ShouldQueue
{
    use Queueable;

    /**
     * The integration instance.
     *
     * @var Integration
     */
    protected $integration;

    /**
     * Create a new job instance.
     */
    public function __construct(Integration $integration)
    {
        $this->integration = $integration;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->integration->type === 'shopify') {
            $apiClient = new ShopifyApiClient($this->integration->access_token, $this->integration->content['shop_domain']);
            $orderMapper = new ShopifyOrderMapper();
            $orderImporter = new ShopifyOrderImporter($apiClient, $orderMapper);

            $orderImporter->import();
        }
    }
}
