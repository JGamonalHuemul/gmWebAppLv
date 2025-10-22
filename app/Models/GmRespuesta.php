<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GmRespuesta extends Model
{
    use HasFactory;

    protected $table = 'gmRespuesta';
    protected $primaryKey = 'respuestaId';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'respuestaId', 'clienteId', 'encuestaId', 'preguntaId', 'preguntaOpId', 'respuestaValor',
        'respuestaTxtAnalizada', 'respuestaTxTEsValida', 'respuestaTxtEsValidaMot',
        'respuestaTxtVector', 'respuestaTxtEsPositiva', 'respuestaPositiva', 'respuestaNegativa',
        'respuestaTxtEmociones', 'respuestaEmoAlegria', 'respuestaEmoTristeza', 'respuestaEmoIra',
        'respuestaEmoMiedo', 'respuestaEmoAnsiedad', 'respuestaEmoDesagrado', 'respuestaEmoSorpresa',
        'respuestaEmoAfecto', 'respuestaEmoCulpa', 'respuestaEmoNeutro', 'respuestaEntidad',
        'respuestaEntPersona', 'respuestaEntSucursal', 'respuestaEntFecha', 'respuestaEntProducto',
        'respuestaEntServicio', 'respuestaEntLugar', 'respuestaEntOtros', 'RespuestaFecha',
        'RespuestaFechaTs', 'respuestaSesionId', 'respuestaClusterId', 'ordenPregunta',
        'respuestaResumen', 'respuestaResumenTrad', 'sucursalId', 'sectorId'
    ];

    public function cliente() { return $this->belongsTo(GmCliente::class, 'clienteId', 'clienteId'); }
    public function encuesta() { return $this->belongsTo(GmEncuesta::class, 'encuestaId', 'encuestaId'); }
    public function pregunta() { return $this->belongsTo(GmPregunta::class, 'preguntaId', 'preguntaId'); }
    public function preguntaOp() { return $this->belongsTo(GmPreguntaOp::class, 'preguntaOpId', 'preguntaOpId'); }
}
