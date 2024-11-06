<?php

namespace Database\Factories;

use App\Models\Receita;
use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ReceitaFactory extends Factory
{
    protected $model = Receita::class;

    public function definition()
    {
        // Gera uma data aleatória nos últimos 12 meses
        $createdAt = $this->faker->dateTimeBetween('-1 year', 'now');

        return [
            'descricao' => $this->faker->sentence(3), // Descrição curta
            'cliente_id' => Cliente::factory(), // Gera um cliente relacionado
            'valor' => $this->faker->randomFloat(2, 100, 10000), // Valor entre 100 e 10,000 com duas casas decimais
            'data_recebimento' => $this->faker->date('Y-m-d', $createdAt), // Data de recebimento até a data de criação
            'metodo_pagamento' => $this->faker->randomElement(['transferência', 'cartão', 'dinheiro', 'boleto']),
            'fatura_numero' => $this->faker->optional()->numerify('FAT-#####'), // Número da fatura opcional
            'status_pagamento' => $this->faker->randomElement(['concluido', 'pendente', 'atrasado']),
            'created_at' => $createdAt, // Data de criação específica
            'updated_at' => $createdAt, // Mantém o mesmo valor do created_at
        ];
    }
}
