<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GmAnalisisCluster extends Model
{
    use HasFactory;

    protected $table = 'gmAnalisisCluster';
    protected $primaryKey = 'analisisClusterId';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'analisisClusterId', 'analisisIdCab', 'preguntaId',
        'analisisClusterVectorAvg', 'analisisClusterResumen', 'analisisClusterNombre'
    ];

    public function analisisCab() { return $this->belongsTo(GmAnalisisCab::class, 'analisisIdCab', 'analisisCabId'); }
}
