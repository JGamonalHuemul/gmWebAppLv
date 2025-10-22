<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GmAnalisisOp extends Model
{
    use HasFactory;

    protected $table = 'gmAnalisisOp';
    protected $primaryKey = 'analsisOpId';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'analsisOpId', 'analisisPregId', 'analisisCabId', 'encuestaId', 'preguntaId',
        'preguntaOpId', 'analisisOpCant', 'analisisDetTxtClusterNum', 'analisisDetTxtVectorAvg'
    ];

    public function analisisPreg() { return $this->belongsTo(GmAnalisisPreg::class, 'analisisPregId', 'analisisPregId'); }
}
