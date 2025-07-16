<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class UserCreated extends ChartWidget
{
    protected static ?string $heading = 'Siswa Baru';

   

    protected function getData(): array
    {
        $data = Trend::model(User::class)->between(
            start : now()->startOfYear(),
            end : now()->endOfYear(),
        )
        ->perMonth()
        ->count();
            return [
                'datasets' => [
                [
                    'label' => 'Siswa Baru',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
