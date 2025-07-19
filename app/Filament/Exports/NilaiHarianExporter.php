<?php

namespace App\Filament\Exports;

use App\Models\NilaiHarian;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class NilaiHarianExporter extends Exporter
{
    protected static ?string $model = NilaiHarian::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id'),
            ExportColumn::make('nis')->label('Nomor Induk Siswa'),
            ExportColumn::make('nama_siswa')->label('Nama Siswa'),
            ExportColumn::make('kelas_siswa')->label('Kelas'),
            ExportColumn::make('mata_pelajaran')->label('Mata Pelajaran'),
            ExportColumn::make('nilai')->label('Nilai Siswa'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your nilai harian export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
