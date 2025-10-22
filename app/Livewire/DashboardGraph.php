<?php

namespace App\Livewire;

use Filament\Widgets\ChartWidget;

class DashboardGraph extends ChartWidget
{
 protected ?string $heading = 'Dashboard Graph';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'NPS',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
