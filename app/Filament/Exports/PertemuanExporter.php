<?php

namespace App\Filament\Exports;

use App\Models\Pertemuan;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class PertemuanExporter extends Exporter
{
    protected static ?string $model = Pertemuan::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')->label('Nomor Induk Siswa'),
            ExportColumn::make('nis')->label('Nomor Induk Siswa'),
            ExportColumn::make('nama_siswa')->label('Nama Siswa'),
            
            ExportColumn::make('kelas_siswa')->label('Kelas'),
            
            
            ExportColumn::make('keterangan')->label('Keterangan'),
            ExportColumn::make('done')->label('Selesai'),
            ExportColumn::make('image')->label('Image_link'),
           
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your pertemuan export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
