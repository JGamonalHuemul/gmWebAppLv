<?php

namespace App\Livewire;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use App\Models\MetricasMensual;
use App\Models\MetricasSemanal;
use App\Models\MetricasTrimestral;
use DateTime;
use Livewire\Attributes\Reactive;

class DashboardGraph extends ChartWidget
{

    protected ?string $heading = 'Evolutivo NPS e ISN';
    protected ?string $pollingInterval = null;


    
    #[Reactive]
    public $clientId;

    #[Reactive]
    public $selectedTime;

    #[Reactive]
    public $selectedBranch;

    #[Reactive]
    public $startDate;

    #[Reactive]
    public $endDate;


    protected function getData(): array
    {

        // Variables de ejemplo
        $client_id = $this->clientId; // ID del cliente seleccionado
        $nps_row_filter = 'NPS';
        $isn_row_filter = 'ISN';
        $selected_branch = null; // o "Sucursal Norte"
        $start_date = $this->startDate; // o '2025-01-01'
        $end_date = $this->endDate; // o '2025-06-30'

        
        match ($this->selectedTime) {
            'semanal' => $group_col = 'semana',
            'mensual' => $group_col = 'mes',
            'trimestral' => $group_col = 'trimestre',
            default => $group_col = 'mes',
        };

        match ($this->selectedTime) {
            'semanal' => $order_col = 'semana',
            'mensual' => $order_col = 'mes',
            'trimestral' => $order_col = 'trimestre',
            default => $order_col = 'mes',
        };

        match ($this->selectedTime) {
            'semanal' => $model = MetricasSemanal::class,
            'mensual' => $model = MetricasMensual::class,
            'trimestral' => $model = MetricasTrimestral::class,
            default => $model = MetricasMensual::class,
        };
        // Etiquetas NPS
        $nps_promotor_label = 'Promotor';
        $nps_detractor_label = 'Detractor';

        $isn_promotor_label = 'Satisfecho';
        $isn_detractor_label = 'Insatisfecho';

        // Columna de agrupación (equivalente a default_column)
        $order_col = $group_col;

        // Construir query
        $query = $model::select([
            DB::raw('"'.$group_col.'"'),
            DB::raw('COUNT("respuestaId") AS total_respuestas'),
            DB::raw('(COUNT(*) FILTER (WHERE "nps_interpretacion" = \''.$nps_promotor_label.'\') * 100.0) / COUNT(*) FILTER (WHERE "preguntaClase" = \''.$nps_row_filter.'\') AS porcentaje_promotores_nps'),
            DB::raw('(COUNT(*) FILTER (WHERE "nps_interpretacion" = \''.$nps_detractor_label.'\') * 100.0) / COUNT(*) FILTER (WHERE "preguntaClase" = \''.$nps_row_filter.'\') AS porcentaje_detractores_nps'),
            DB::raw('(COUNT(*) FILTER (WHERE "isn_interpretacion" = \''.$isn_promotor_label.'\') * 100.0) / COUNT(*) FILTER (WHERE "preguntaClase" = \''.$isn_row_filter.'\') AS porcentaje_promotores_isn'),
            DB::raw('(COUNT(*) FILTER (WHERE "isn_interpretacion" = \''.$isn_detractor_label.'\') * 100.0) / COUNT(*) FILTER (WHERE "preguntaClase" = \''.$isn_row_filter.'\') AS porcentaje_detractores_isn'),
        ])
        ->where(DB::raw('"cliente"'), $client_id);
    
        if ($selected_branch) {
            $query->where('branch_name', $selected_branch);
        }

        if ($start_date) {
            match ($this->selectedTime) {
                'semanal' => $start_date = date('Y-\WW', strtotime($start_date . ' -7 days')),   // Ej: 25-W42
                'mensual' => $start_date = date('Y-m', strtotime($start_date . ' -1 month')),    // Ej: 25-09
                'trimestral' => $start_date = (function () use ($start_date) {
                    $date = new DateTime($start_date);
                    $date->modify('-3 months');
                    $quarter = ceil($date->format('n') / 3); // trimestre actual
                    return $date->format('Y') . 'Q' . str_pad($quarter, 2, '0', STR_PAD_LEFT); // Ej: 25Q01
                })(),
                default => $start_date,
            };
            $query->where($group_col, '>=', $start_date);
        }

        if ($end_date) {
            $query->where($group_col, '<=', $end_date);
        }

        
        $query->groupBy($group_col)
            ->orderBy($order_col);
        $respuestas = $query->get();
        $labels = $respuestas->pluck($group_col)->toArray();
        $porcentaje_promotores = $respuestas->pluck('porcentaje_promotores_nps')->toArray();
        $porcentaje_detractores = $respuestas->pluck('porcentaje_detractores_nps')->toArray();
        $nps_values =  array_map(function($promotores, $detractores) {
            return $promotores - $detractores;
        }, $porcentaje_promotores, $porcentaje_detractores);
        $porcentaje_promotores = $respuestas->pluck('porcentaje_promotores_isn')->toArray();
        $porcentaje_detractores = $respuestas->pluck('porcentaje_detractores_isn')->toArray();
        $isn_values =  array_map(function($promotores, $detractores) {
            return $promotores - $detractores;
        }, $porcentaje_promotores, $porcentaje_detractores);
        return [
            'datasets' => [
                [
                    'label' => 'NPS',
                    'data' => $nps_values,
                    'borderColor' => 'rgb(75, 192, 192)',
                ],
                [
                    'label' => 'ISN',
                    'data' => $isn_values,
                    'borderColor' => 'rgb(153, 102, 255)',
                ]
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
