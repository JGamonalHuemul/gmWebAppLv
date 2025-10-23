<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbiertasSemanal extends Model
{
    // Nombre de la tabla
    protected $table = 'respuestas_abiertas_weekly';

    // Esta tabla no tiene timestamps (created_at / updated_at)
    public $timestamps = false;

    // Esta tabla no tiene una clave primaria única
    protected $primaryKey = null;
    public $incrementing = false;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'pregunta',
        'cliente',
        'respuestaId',
        'respuestaEmoAlegria',
        'respuestaEmoTristeza',
        'respuestaEmoIra',
        'respuestaEmoMiedo',
        'respuestaEmoAnsiedad',
        'respuestaEmoDesagrado',
        'respuestaEmoSorpresa',
        'respuestaEmoAfecto',
        'respuestaEmoCulpa',
        'respuestaEmoNeutro',
        'preguntaClase',
        'respuestaValor',
        'branch_name',
        'sector_name',
        'trimestre',
        'respuestaClusterId',
    ];
}
