<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GmAnalisisCab extends Model
{
    use HasFactory;

    protected $table = 'gmAnalisisCab';
    protected $primaryKey = 'analisisCabId';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'analisisCabId', 'clienteId', 'encuestaId', 'analisisCabNombre', 'analisisDesde', 'analisisHasta'
    ];

    public function cliente() { return $this->belongsTo(GmCliente::class, 'clienteId', 'clienteId'); }
    public function clusters() { return $this->hasMany(GmAnalisisCluster::class, 'analisisIdCab', 'analisisCabId'); }
    public function analisisPreg() { return $this->hasMany(GmAnalisisPreg::class, 'analisisCabId', 'analisisCabId'); }
}
