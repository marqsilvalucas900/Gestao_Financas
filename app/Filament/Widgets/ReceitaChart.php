<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Receita;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ReceitaChart extends ChartWidget
{
    protected static ?string $heading = 'Receita';
    protected int | string | array $columnSpan = [
        'md' => 2,
        'xl' => 3,
    ];
    protected function getData(): array
    {
        $data = Trend::model(Receita::class)
            ->between(start: now()->subYear(), end: now()) // Usando Carbon para criar as datas
            ->perMonth()
            ->sum('valor');

        // dd($data); // Exibe os dados da tendência
        // dd( $data->map(fn(TrendValue $value) => $value->aggregate));
        // dd($data->map(fn(TrendValue $value) => $value->date));
        return [
            'datasets' => [
                [
                    'label' => 'Receitas por Mês',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
