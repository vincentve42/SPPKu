<?php

namespace App\Filament\Imports;


use App\Filament\Resources\PembayaranResource\Widgets\Kategori;
use App\Models\Siswa;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Facades\Auth;

class SiswaImporter extends Importer
{
    protected static ?string $model = Siswa::class;

    public static function getColumns(): array
    {
        return [
           
            ImportColumn::make("nis")->rules(['required'])->label('Nomor Induk Siswa'),
            ImportColumn::make("nama")->rules(['required']),
            ImportColumn::make("absen")->rules(['required']),
            ImportColumn::make('harga')->rules(['required']),
            ImportColumn::make('kelas')->rules(['required']),
            ImportColumn::make('kelas_id')->rules(['required'])->integer(),
            
            ImportColumn::make('kategori')->rules(['required']),
            

            
        ];
    }
    
    public function resolveRecord(): ?Siswa
    {
       
        
        return new Siswa(['user_id' => Auth::id()]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your siswa import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
