<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GmSesionAnalytics extends Model
{
    use HasFactory;

    protected $table = 'gmSesionAnalytics';
    protected $primaryKey = 'gmSesionAnalyticsId';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'gmSesionAnalyticsId', 'clienteId', 'encuestaId', 'respuestaSesionId',
        'RespuestaFecha', 'preguntaIdAgrupa', 'valorNPS', 'valorISN', 'clusterId',
        'valorTextoLibre'
    ];

    public function cliente() { return $this->belongsTo(GmCliente::class, 'clienteId', 'clienteId'); }
    public function encuesta() { return $this->belongsTo(GmEncuesta::class, 'encuestaId', 'encuestaId'); }
}
