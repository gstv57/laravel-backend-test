<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome'               => $this->faker->name,
            'email'              => $this->faker->email,
            'telefone'           => $this->getTelefone(),
            'data_de_nascimento' => $this->faker->date('Y-m-d', '-30 years'),
            'cpf'                => $this->getCPF(),
            'sexo'               => 'm',
            'created_at'         => now(),
            'updated_at'         => now(),
        ];
    }

    private function getCPF()
    {
        $n1 = rand(0, 9);
        $n2 = rand(0, 9);
        $n3 = rand(0, 9);
        $n4 = rand(0, 9);
        $n5 = rand(0, 9);
        $n6 = rand(0, 9);
        $n7 = rand(0, 9);
        $n8 = rand(0, 9);
        $n9 = rand(0, 9);

        // Calculando o primeiro dígito verificador
        $d1 = $n9 * 2 + $n8 * 3 + $n7 * 4 + $n6 * 5 + $n5 * 6 + $n4 * 7 + $n3 * 8 + $n2 * 9 + $n1 * 10;
        $d1 = 11 - ($d1 % 11);

        if ($d1 >= 10) {
            $d1 = 0;
        }

        // Calculando o segundo dígito verificador
        $d2 = $d1 * 2 + $n9 * 3 + $n8 * 4 + $n7 * 5 + $n6 * 6 + $n5 * 7 + $n4 * 8 + $n3 * 9 + $n2 * 10 + $n1 * 11;
        $d2 = 11 - ($d2 % 11);

        if ($d2 >= 10) {
            $d2 = 0;
        }

        // Concatena os números para formar o CPF completo
        $cpf = "$n1$n2$n3$n4$n5$n6$n7$n8$n9$d1$d2";

        return $cpf;
    }
    private function getTelefone()
    {
        $ddd = str_pad(rand(11, 99), 2, '0', STR_PAD_LEFT);
        $numero = '9' . str_pad(rand(100000000, 999999999), 9, '0', STR_PAD_LEFT);

        return $ddd . $numero;
    }
}
