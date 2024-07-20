<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $nomes = [
            'Smartphone',
            'Laptop',
            'Cadeira de escritório',
            'Monitor LED',
            'Teclado mecânico',
            'Mouse sem fio',
            'Fone de ouvido',
            'Smartwatch',
            'Câmera digital',
            'Impressora multifuncional',
            'Mesa de jantar',
            'Geladeira',
            'Micro-ondas',
            'Máquina de café',
            'Aspirador de pó',
            'Secador de cabelo',
            'Roteador Wi-Fi',
            'Smart TV',
            'Consola de videogame',
            'Caixa de som Bluetooth',
        ];
        $random = array_rand($nomes);

        return [
            'nome'       => $nomes[$random],
            'descricao'  => $this->faker->sentence(10),
            'preco'      => $this->faker->randomFloat(2, 10, 1000),
            'quantidade' => $this->faker->numberBetween(1, 200),
            'status'     => $this->faker->boolean,
        ];
    }

}
