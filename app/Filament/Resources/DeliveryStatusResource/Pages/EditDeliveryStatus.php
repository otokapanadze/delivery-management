<?php

namespace App\Filament\Resources\DeliveryStatusResource\Pages;

use App\Filament\Resources\DeliveryUpdateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDeliveryStatus extends EditRecord
{
    protected static string $resource = DeliveryUpdateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
