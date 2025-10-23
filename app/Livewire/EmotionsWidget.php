<?php

namespace App\Livewire;

use App\Models\AbiertasMensual;
use App\Models\AbiertasSemanal;
use Illuminate\Support\Facades\DB;
use App\Models\AbiertasTrimestral;
use Filament\Widgets\ChartWidget;
use Livewire\Attributes\Reactive;

class EmotionsWidget extends ChartWidget
{
    protected ?string $heading = 'Emotions Widget';
    protected ?string $pollingInterval = null;

        
    #[Reactive]
    public $clientId;

    #[Reactive]
    public $selectedTime;

    #[Reactive]
    public $selectedBranch;

    #[Reactive]
    public $selectedSector;

    #[Reactive]
    public $startDate;

    #[Reactive]
    public $endDate;

    protected function getData(): array
    {
        // Variables de ejemplo
        $client_id = $this->clientId; // ID del cliente seleccionado
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
            'semanal' => $model = AbiertasSemanal::class,
            'mensual' => $model = AbiertasMensual::class,
            'trimestral' => $model = AbiertasTrimestral::class,
            default => $model = AbiertasMensual::class,
        };

        $emotions = ["respuestaEmoAlegria", "respuestaEmoTristeza", "respuestaEmoIra", "respuestaEmoMiedo", "respuestaEmoAnsiedad", "respuestaEmoDesagrado", "respuestaEmoSorpresa", "respuestaEmoAfecto", "respuestaEmoCulpa", "respuestaEmoNeutro",];

        $selects = [
            'mes',
            DB::raw('COUNT("respuestaId") AS total_respuestas'),
        ];

        foreach ($emotions as $emo) {
            $selects[] = DB::raw("COUNT(CASE WHEN \"$emo\" >= 50 THEN 1 END) AS". '"' . "count_$emo" . '"');
            $selects[] = DB::raw("AVG(NULLIF(\"$emo\", 0)) AS" . '"' . "avg_$emo" . '"');
        }

        $query = AbiertasMensual::select($selects)
            ->when($selectedBranch ?? null, fn($q) => $q->where('branch_name', $selected_branch))
            ->groupBy('mes')
            ->orderBy('mes');

        $query = $query->where('cliente', $client_id);
        
        $emotions_datasets = [];
        $labels = [];
        
        foreach ($emotions as $emo) {
            $emo_label = str_replace('respuestaEmo', '', $emo);
            $emotions_datasets[$emo_label] = [
                'label' => $emo_label,
                'data' => $query->pluck("avg_$emo"),
                'borderColor' => sprintf('hsl(%d, 70%%, 50%%)', rand(0, 360)),
            ];
        }
        $labels = $query->pluck($group_col);
        return [
            'datasets' => [
                ...array_values($emotions_datasets)
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
