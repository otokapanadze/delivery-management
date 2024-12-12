<?php

namespace App\Filament\Resources\IntegrationResource\Pages;

use App\Filament\Resources\IntegrationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateIntegration extends CreateRecord
{
    protected static string $resource = IntegrationResource::class;

    /**
     * Redirect to Shopify after creation if the type is Shopify.
     */
    protected function afterCreate()
    {
        if ($this->record->type === 'shopify') {
            $shopDomain = $this->record->content['shop_domain'] ?? null;

            if ($shopDomain) {
                return redirect()->route('integration.shopify.redirect', ['shop' => $shopDomain]);
            }
        }
    }
}
