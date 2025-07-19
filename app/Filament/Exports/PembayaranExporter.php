<?php

namespace App\Filament\Exports;

use App\Models\Pembayaran;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class PembayaranExporter extends Exporter
{
    protected static ?string $model = Pembayaran::class;

    public static function getColumns(): array
    {
        return [
           ExportColumn::make('id'),
           ExportColumn::make('nis')->label('Nomor Induk Siswa'),
           ExportColumn::make('nama_siswa')->label('Nama Siswa'),
           ExportColumn::make('harga')->label('Harga SPP'),
           ExportColumn::make('dibayar')->label('Status Pembayaran'),
           ExportColumn::make('updated_at')->label('Tanggal Dibuat'),
           ExportColumn::make('image')->label('Image Link'),
        
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your pembayaran export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
