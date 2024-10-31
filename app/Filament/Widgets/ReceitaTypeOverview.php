<?php

namespace App\Filament\Widgets;

use App\Models\Receita;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ReceitaTypeOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Concluídos', Receita::query()->where('status_pagamento', 'concluido')->count()),
            Stat::make('Pendentes', Receita::query()->where('status_pagamento', 'pendente')->count()),
            Stat::make('Atrasados', Receita::query()->where('status_pagamento', 'atrasado')->count()),
        ];
    }
}
