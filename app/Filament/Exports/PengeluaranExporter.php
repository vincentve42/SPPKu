<?php

namespace App\Filament\Exports;

use App\Models\Pengeluaran;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class PengeluaranExporter extends Exporter
{
    protected static ?string $model = Pengeluaran::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id'),
             ExportColumn::make('user_id'),
            ExportColumn::make('nama')->label('Keterangan'),
            ExportColumn::make('harga')->label('Harga'),
            ExportColumn::make('created_at')->label('Tanggal Transaksi'),
            ExportColumn::make('image')->label('Image Link')
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your pengeluaran export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
