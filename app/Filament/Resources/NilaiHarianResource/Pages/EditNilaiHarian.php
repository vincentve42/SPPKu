<?php

namespace App\Filament\Resources\NilaiHarianResource\Pages;

use App\Filament\Resources\NilaiHarianResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNilaiHarian extends EditRecord
{
    protected static string $resource = NilaiHarianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
