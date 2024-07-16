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
        return [
            'nome' => $this->faker->word,
            'descricao' => $this->faker->paragraph,
            'preco' => $this->faker->randomFloat(2, 1, 1000),
            'quantidade' => $this->faker->numberBetween(1, 100),
            'ativo' => $this->faker->boolean,
        ];
    }
}
