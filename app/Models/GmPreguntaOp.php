<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GmPreguntaOp extends Model
{
    use HasFactory;

    protected $table = 'gmPreguntaOp';
    protected $primaryKey = 'preguntaOpId';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'preguntaOpId', 'preguntaOpNombre', 'preguntaId', 'preguntaOpIndice',
        'preguntaOpEvaluacion', 'preguntaOpColor', 'preguntaOpImagen', 'preguntaOpValor',
        'preguntaOpPositiva', 'preguntaOpNegativa', 'preguntaOpNeutral'
    ];

    public function pregunta() { return $this->belongsTo(GmPregunta::class, 'preguntaId', 'preguntaId'); }
}
