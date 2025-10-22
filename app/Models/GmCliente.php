<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class GmCliente extends Model
{
    use HasFactory;

    protected $table = 'gmCliente';
    protected $primaryKey = 'clienteId';
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['clienteId', 'clienteNombre', 'clienteImg', 'tablaMysql', 'showWeb'];

    public function encuestas() { return $this->hasMany(GmEncuesta::class, 'clienteId', 'clienteId'); }
    public function respuestas() { return $this->hasMany(GmRespuesta::class, 'clienteId', 'clienteId'); }
    public function sesiones() { return $this->hasMany(GmSesionAnalytics::class, 'clienteId', 'clienteId'); }
    public function sucursales() { return $this->hasMany(GmSucursal::class, 'clienteId', 'clienteId'); }
    public function analisisCabs() { return $this->hasMany(GmAnalisisCab::class, 'clienteId', 'clienteId'); }
}
