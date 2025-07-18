<?php

namespace App\Filament\Resources\NilaiSemesterResource\Pages;

use App\Filament\Resources\NilaiSemesterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNilaiSemester extends EditRecord
{
    protected static string $resource = NilaiSemesterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
