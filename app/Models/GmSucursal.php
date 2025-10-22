<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GmSucursal extends Model
{
    use HasFactory;

    protected $table = 'gmSucursal';
    protected $primaryKey = 'sucursalId';
    public $incrementing = true;

    protected $fillable = ['clienteId', 'sucursalNombre'];

    public function cliente() { return $this->belongsTo(GmCliente::class, 'clienteId', 'clienteId'); }
    public function sectores() { return $this->hasMany(GmSector::class, 'sucursalId', 'sucursalId'); }
}
