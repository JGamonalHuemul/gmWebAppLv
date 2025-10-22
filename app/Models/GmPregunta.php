<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GmPregunta extends Model
{
    use HasFactory;

    protected $table = 'gmPregunta';
    protected $primaryKey = 'preguntaId';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'preguntaId', 'preguntaNombre', 'encuestaId', 'preguntaClase', 'preguntaTipo',
        'preguntaDesde', 'preguntaHasta', 'preguntaTxtClusterNum', 'preguntaVector',
        'preguntaIdPadre', 'preguntaIdAgrupa', 'preguntaIndice', 'preguntavalida'
    ];

    public function encuesta() { return $this->belongsTo(GmEncuesta::class, 'encuestaId', 'encuestaId'); }
    public function opciones() { return $this->hasMany(GmPreguntaOp::class, 'preguntaId', 'preguntaId'); }
    public function respuestas() { return $this->hasMany(GmRespuesta::class, 'preguntaId', 'preguntaId'); }
}
