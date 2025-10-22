<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GmAnalisisPreg extends Model
{
    use HasFactory;

    protected $table = 'gmAnalisisPreg';
    protected $primaryKey = 'analisisPregId';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'analisisPregId', 'analisisCabId', 'encuestaId', 'preguntaId',
        'analisisDetCantEncuesta', 'analisisDetCant', 'analisisDetCantValida',
        'analisisDetCantPositivo', 'analisisDetCantNegativo', 'analisisDetCantNeutro',
        'analisisDetTxtClusterNum', 'analisisDetTxtVectorAvg'
    ];

    public function analisisCab() { return $this->belongsTo(GmAnalisisCab::class, 'analisisCabId', 'analisisCabId'); }
    public function analisisOps() { return $this->hasMany(GmAnalisisOp::class, 'analisisPregId', 'analisisPregId'); }
}
