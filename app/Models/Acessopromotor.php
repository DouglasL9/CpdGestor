<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acessopromotor extends Model
{
    use HasFactory;
    protected $table = "acessopromotor";
    protected $fillable = [
        'filial_id',
        'numero',
        'nome',
        'mateusid',
        'cpf',
        'senha',
    ];
}
