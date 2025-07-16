<?php

namespace App\Filament\Resources\KategoriResource\Pages;

use App\Filament\Resources\KategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateKategori extends CreateRecord
{
    
    protected static string $resource = KategoriResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data["user_id"] = Auth::id();
        return $data;
    }
}
