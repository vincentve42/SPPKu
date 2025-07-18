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
        // Data
        // Keuangan
        $data_keuangan = Auth::user()->Kelas->find($data["kelas_id"]);

        // Siswa
        $data_siswa = Auth::user()->Siswa->find($data["siswa_id"]);

        //  Kategori

        $data['nama_kategori'] = $data_keuangan->nama;
        $data['harga'] = $data_keuangan->harga;

        //  Siswa

        $data['nama_siswa'] = $data_siswa->nama;
        $data['user_id'] = Auth::id();

        $data["nis"] = $data_siswa->nis;
        return $data;
    }
    
}
