<?php

namespace App\Filament\Resources\SuratPeringatanResource\Pages;

use App\Filament\Resources\SuratPeringatanResource;
use App\Models\Siswa;
use Auth;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSuratPeringatan extends CreateRecord
{
    protected static string $resource = SuratPeringatanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        //
        $data_siswa = Auth::user()->Siswa->find($data["siswa_id"]);
        $data_surat = $data_siswa->SuratPeringatan->count();

        //
        $data["user_id"] = Auth::id();
        $data["nama_siswa"] = $data_siswa->nama;
        $data["kelas_siswa"] = $data_siswa->kelas;
        $data["nis"] = $data_siswa->nis;
        $data["surat"] = $data_surat += 1;;
        return $data;
    }
}
