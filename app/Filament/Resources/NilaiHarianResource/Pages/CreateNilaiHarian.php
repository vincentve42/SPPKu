<?php

namespace App\Filament\Resources\NilaiHarianResource\Pages;

use App\Filament\Resources\NilaiHarianResource;
use App\Models\NilaiSemester;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateNilaiHarian extends CreateRecord
{
    protected static string $resource = NilaiHarianResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data_siswa = Auth::user()->Siswa->find($data["siswa_id"]);
        $data_mapel = Auth::user()->MataPelajaran->find($data["mata_id"]);
        $cek_semester = Auth::user()->NilaiHarian->where("mata_pelajaran", $data_mapel->nama)->count();

        //

        if($cek_semester > 0)
        {
            $data["user_id"] = Auth::id();
            $data["nama_siswa"] = $data_siswa->nama;
            $data["kelas_siswa"] = $data_siswa->kelas;
            $data["nis"] = $data_siswa->nis;
            $data["mata_pelajaran"] = $data_mapel->nama;
            $data["absen_siswa"] = $data_siswa->absen;
            
            //
            $nilai_semester = $data_siswa->NilaiSemester->where("mata_pelajaran", $data_mapel->nama)->first(); 
            $nilai_harian = $data_siswa->NilaiHarian->where("mata_pelajaran", $data_mapel->nama); 
            $total_nilai = $data["nilai"];
            $count = 1;
            // return dd($nilai_harian);
           
            foreach($nilai_harian as $single_data)
            {
                $count++;
                $total_nilai += $single_data->nilai;
            
            }
            $nilai_input = $total_nilai / $count;

            $nilai_semester->nilai = $nilai_input;

            $nilai_semester->save();


            
        }
        else
        {
            $data["user_id"] = Auth::id();
            $data["nama_siswa"] = $data_siswa->nama;
            $data["kelas_siswa"] = $data_siswa->kelas;
            $data["nis"] = $data_siswa->nis;
            $data["mata_pelajaran"] = $data_mapel->nama;
            $data["absen_siswa"] = $data_siswa->absen;
            //
            $nilai_semester = new NilaiSemester;
            $nilai_semester->siswa_id = $data["siswa_id"];
            $nilai_semester->nis = $data_siswa->nis;
            $nilai_semester->kelas_siswa = $data_siswa->kelas;
            $nilai_semester->user_id = Auth::id();
            $nilai_semester->nama_siswa = $data_siswa->nama;
            $nilai_semester->absen_siswa = $data_siswa->absen;
            $nilai_semester->mata_pelajaran = $data_mapel->nama;
            $nilai_semester->nilai = $data["nilai"];
            $nilai_semester->mata_id = $data['mata_id'];

            $nilai_semester->save();



        }
        

        return $data;
    }
    
}
