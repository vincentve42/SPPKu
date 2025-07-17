<?php

namespace App\Filament\Widgets;

use App\Models\Siswa;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Type\Integer;


class Pembayaran extends BaseWidget
{
    
    protected function getStats(): array
    {
        return [
            Stat::make('Sekolah ID',Auth::id()),
            Stat::make("Siswa",Auth::user()->Siswa->count())->description("Jumlah Siswa")->descriptionIcon("heroicon-m-academic-cap",IconPosition::Before)
            ->chart([10,10,10,10,10])->color('info'),
            Stat::make("Pendapatan", User::HitungSemuaPendapatans(Auth::id()))->description("Jumlah Pendapatan")->descriptionIcon("heroicon-m-currency-dollar",IconPosition::Before)
            ->chart([10,10,10,10,10])->color('success'),
            Stat::make("Pengeluaran",User::HitungSemuaPengeluaran(Auth::id()))->description("Jumlah Pengeluaran")->descriptionIcon("heroicon-m-banknotes",IconPosition::Before)
            ->chart([10,10,10,10,10])->color('danger'),
        ];
    }
}
