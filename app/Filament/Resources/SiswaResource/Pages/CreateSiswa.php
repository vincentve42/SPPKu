<?php

namespace App\Filament\Resources\SiswaResource\Pages;

use App\Filament\Resources\SiswaResource;
use App\Models\Kelas;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CreateSiswa extends CreateRecord
{
    protected static string $resource = SiswaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data["user_id"] = Auth::user()->id;
        $data_kategori = Kelas::find($data["kelas_id"]);
        $data["kategori"] = $data_kategori->nama;
        $data["harga"] = $data_kategori->harga;
        return $data;
    }  
}
