<?php

namespace App\Filament\Resources\SuratPeringatanResource\Pages;

use App\Filament\Resources\SuratPeringatanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSuratPeringatans extends ListRecords
{
    protected static string $resource = SuratPeringatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
