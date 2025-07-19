<?php

namespace App\Filament\Exports;

use App\Models\Kelas;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class KelasExporter extends Exporter
{
    protected static ?string $model = Kelas::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id'),
            ExportColumn::make('nama')->label('Kategori'),
            ExportColumn::make('harga')->label('Harga')
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your kelas export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
