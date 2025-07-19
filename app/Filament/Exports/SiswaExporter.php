<?php

namespace App\Filament\Exports;

use App\Models\Siswa;
use Filament\Actions\Exports\ExportColumn;

use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class SiswaExporter extends Exporter
{
    protected static ?string $model = Siswa::class;

    public static function getColumns(): array
    {
        return [
           ExportColumn::make("id"),
           ExportColumn::make("nis")->label('Nomor Induk Siswa'),
           ExportColumn::make("nama")->label("Nama Siswa"),
           ExportColumn::make("kelas")->label("Kelas"),
           ExportColumn::make("absen")->label("Absen"),
           ExportColumn::make("kategori")->label("Kategori"),
           ExportColumn::make("harga")->label("Harga"),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your siswa export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
