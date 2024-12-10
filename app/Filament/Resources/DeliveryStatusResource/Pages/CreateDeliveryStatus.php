<?php

namespace App\Filament\Resources\DeliveryStatusResource\Pages;

use App\Filament\Resources\DeliveryUpdateResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDeliveryStatus extends CreateRecord
{
    protected static string $resource = DeliveryUpdateResource::class;
}
