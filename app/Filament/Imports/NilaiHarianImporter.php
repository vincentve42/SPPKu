<?php

namespace App\Filament\Imports;

use App\Models\NilaiHarian;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Facades\Auth;

class NilaiHarianImporter extends Importer
{
    protected static ?string $model = NilaiHarian::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('nis')->label('Nomor Induk Siswa'),
            ImportColumn::make('siswa_id')->label('ID Siswa'),
            ImportColumn::make('nama_siswa')->label('Nama Siswa'),
            ImportColumn::make('kelas_siswa')->label('Kelas'),
            ImportColumn::make('absen_siswa')->label('Absen'),
            ImportColumn::make('mata_pelajaran')->label('Mata Pelajaran'),
            ImportColumn::make('mata_id')->label('Link to matapelajaran id  ( di website kalau belum ada create baru terus idnya diisi yang tampil di web)'),
            ImportColumn::make('nilai')->label('Nilai Siswa'),
            
        ];
    }

    public function resolveRecord(): ?NilaiHarian
    {
        // return NilaiHarian::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new NilaiHarian(['user_id' => Auth::user()->id]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your nilai harian import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
