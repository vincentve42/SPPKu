<?php

namespace App\Filament\Resources\PembayaranResource\Pages;

use App\Filament\Resources\PembayaranResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreatePembayaran extends CreateRecord
{
    protected static string $resource = PembayaranResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['harga'] = 0;
        $data['user_id'] = Auth::id();
        return $data;
    }
    
}
