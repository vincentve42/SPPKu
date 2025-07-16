<?php

namespace App\Filament\Widgets;

use Auth;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BelumBayar extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Siswa Belum Bayar',Auth::user()->Pembayaran->where('dibayar','Belum dibayar')->count())->description('Jumlah siswa yang belum melunasi SPP')->descriptionColor('danger'),
            Stat::make('Siswa Lunas',Auth::user()->Pembayaran->where('dibayar','Lunas')->count())->description('Jumlah siswa yang sudah melunasi SPP')->descriptionColor('success'),
            Stat::make('Siswa Lunas',Auth::user()->Pembayaran->where('dibayar','Tidak ditanggungkan')->count())->description('Jumlah siswa yang SPP nya belum di setting / ditentukan')->descriptionColor('info'),
            Stat::make('Beasiswa',Auth::user()->Pembayaran->where('dibayar','Beasiswa')->count())->description('Jumlah siswa yang berprestasi')->descriptionColor('info'),
        ];
    }
}
