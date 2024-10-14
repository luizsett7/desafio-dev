<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CnabTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'data',
        'valor',
        'cpf',
        'cartao',
        'hora',
        'dono_loja',
        'nome_loja'
    ];
}