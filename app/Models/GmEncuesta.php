<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GmEncuesta extends Model
{
    use HasFactory;

    protected $table = 'gmEncuesta';
    protected $primaryKey = 'encuestaId';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['encuestaId', 'encuestaNombre', 'clienteId'];

    public function cliente() { return $this->belongsTo(GmCliente::class, 'clienteId', 'clienteId'); }
    public function preguntas() { return $this->hasMany(GmPregunta::class, 'encuestaId', 'encuestaId'); }
    public function respuestas() { return $this->hasMany(GmRespuesta::class, 'encuestaId', 'encuestaId'); }
    public function sesiones() { return $this->hasMany(GmSesionAnalytics::class, 'encuestaId', 'encuestaId'); }
}
