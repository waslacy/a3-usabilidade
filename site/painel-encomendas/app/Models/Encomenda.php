<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encomenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'user', 'codigo', 'transportadora', 'status', 'ultima_atualizacao', 'ativo'
    ];
}
