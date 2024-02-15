<?php

namespace App\Filament\App\Resources\CareerResource\Pages;

use App\Filament\App\Resources\CareerResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCareers extends ManageRecords
{
    protected static string $resource = CareerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
