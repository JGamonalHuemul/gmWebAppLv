<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GmSector extends Model
{
    use HasFactory;

    protected $table = 'gmSector';
    protected $primaryKey = 'sectorId';
    public $incrementing = true;

    protected $fillable = ['sucursalId', 'sectorNombre'];

    public function sucursal() { return $this->belongsTo(GmSucursal::class, 'sucursalId', 'sucursalId'); }
}
