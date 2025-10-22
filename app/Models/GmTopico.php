<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GmTopico extends Model
{
    use HasFactory;

    protected $table = 'gmTopico';
    protected $primaryKey = 'topicoId';
    public $incrementing = true;

    protected $fillable = [
        'topicoNro', 'clienteId', 'conteoTopico', 'nombreTopico', 'keywordsTopico'
    ];
}
