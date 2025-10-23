<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetricasSemestral extends Model
{
    // Nombre de la vista materializada
    protected $table = 'respuestas_metricas_semester';

    // No tiene timestamps (created_at, updated_at)
    public $timestamps = false;

    // Si la vista no tiene una clave primaria única
    protected $primaryKey = null;
    public $incrementing = false;
    protected $keyType = 'string';

    // Campos permitidos (opcional)
    protected $fillable = [
        'semestre',
        'cliente',
        'respuestaId',
        'branch_name',
        'sector_name',
        'preguntaClase',
        'valor',
        'total_opciones',
        'nps_interpretacion',
        'isn_interpretacion',
    ];
}
