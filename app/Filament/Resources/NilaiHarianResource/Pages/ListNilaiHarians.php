<?php

namespace App\Filament\Resources\NilaiHarianResource\Pages;

use App\Filament\Resources\NilaiHarianResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNilaiHarians extends ListRecords
{
    protected static string $resource = NilaiHarianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
