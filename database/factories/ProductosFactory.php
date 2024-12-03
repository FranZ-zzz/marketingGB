<?php

namespace Database\Factories;

use App\Models\Productos;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductosFactory extends Factory
{
    protected $model = Productos::class;

    public function definition()
    {
        return [
            'codigo' => $this->faker->unique()->numerify('PRD###'),
            'nombre' => $this->faker->word,
            'stock' => $this->faker->numberBetween(1, 100),
            'descripcion' => $this->faker->sentence,
            'stock_minimo' => 5,
            'stock_maximo' => 50,
            'precio_compra' => $this->faker->randomFloat(2, 1, 100),
            'precio_venta' => $this->faker->randomFloat(2, 101, 200),
            'fecha_ingreso' => $this->faker->date(),
            'categoria_id' => Categoria::factory(),
            'empresa_id' => 1, // Configura según tu caso
        ];
    }
}
