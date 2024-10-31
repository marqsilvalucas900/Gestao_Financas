<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
        'cliente_id',
        'valor',
        'data_recebimento',
        'metodo_pagamento',
        'fatura_numero',
        'status_pagamento',
    ];

    // Relação com o modelo Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}

