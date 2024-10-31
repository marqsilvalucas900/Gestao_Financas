<?php

namespace App\Filament\Resources\ReceitaResource\Pages;

use App\Filament\Resources\ReceitaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewReceita extends ViewRecord
{
    protected static string $resource = ReceitaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
