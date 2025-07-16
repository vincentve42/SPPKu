<?php

namespace App\Filament\Resources\PembayaranResource\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class Kategori extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        
        $belumdibayar = Auth::user()->Pembayaran->where('dibayar','Belum dibayar')->count();
        $beasiswa = Auth::user()->Pembayaran->where('dibayar','Beasiswa')->count();
        $lunas = Auth::user()->Pembayaran->where('dibayar','Lunas')->count();
        $belum_ditangguhkan = Auth::user()->Pembayaran->where('dibayar','Tidak ditanggungkan')->count();
        return [
            'datasets' => [
                [
                'label' => 'Kategori',
                'data' => [$belum_ditangguhkan,$beasiswa,$lunas,$belumdibayar],
                            'backgroundColor' => [
                
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(0, 255, 132)',
                'rgb(255, 99, 132)',
                ],
                ],
            ],
            'labels' => ['Belum di tentukan','Beasiswa','Lunas','Belum Dibayar'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
