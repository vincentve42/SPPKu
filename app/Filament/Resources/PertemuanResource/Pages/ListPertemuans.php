<?php

namespace App\Filament\Resources\PertemuanResource\Pages;

use App\Filament\Resources\PertemuanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPertemuans extends ListRecords
{
    protected static string $resource = PertemuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
