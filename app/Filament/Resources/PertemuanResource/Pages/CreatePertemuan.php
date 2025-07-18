<?php

namespace App\Filament\Resources\PertemuanResource\Pages;

use App\Filament\Resources\PertemuanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreatePertemuan extends CreateRecord
{
    protected static string $resource = PertemuanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Data Siswa
        $data_siswa = Auth::user()->Siswa->find($data["siswa_id"]);

        $data["kelas_siswa"] = $data_siswa->kelas;
        $data["nama_siswa"] = $data_siswa->nama;
        $data["user_id"] = Auth::id();
        $data["nis"] = $data_siswa->nis;
        return $data;
    }
}
