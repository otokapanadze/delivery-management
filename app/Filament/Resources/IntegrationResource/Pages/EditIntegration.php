<?php

namespace App\Filament\Resources\IntegrationResource\Pages;

use App\Filament\Resources\IntegrationResource;
use App\Jobs\OrderImportHandler;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditIntegration extends EditRecord
{
    protected static string $resource = IntegrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('connectShopify')
                ->label('Connect Shopify')
                ->url(fn () => route('integration.shopify.redirect', ['shop' => $this->record->content['shop_domain'] ?? '']))
                ->hidden(fn () => $this->record->type !== 'shopify' || $this->record->access_token !== null)
                ->button()
                ->color('primary'),
            Actions\Action::make('importOrders')
                ->label('Import Orders')
                ->visible(fn () => $this->record->access_token !== null)
                ->action(function () {
                    OrderImportHandler::dispatch($this->record);
                    Notification::make()
                        ->title('Order import has been started.')
                        ->success();
                })
//                ->requiresConfirmation()
                ->color('primary'),
        ];
    }
}
