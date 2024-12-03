<?php

namespace Tests\Feature;

use App\Models\Productos;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductosControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Crea un usuario autenticado
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    /** @test */
    public function it_displays_a_list_of_productos()
    {
        // Crea productos de prueba
        $productos = Productos::factory(5)->create();

        // Realiza la petición para la vista
        $response = $this->get(route('admin.productos.index'));

        // Verifica que el estado sea 200 y que los productos estén en la vista
        $response->assertStatus(200);
        $response->assertViewHas('productos', $productos);
    }

    /** @test */
    public function it_displays_the_create_form()
    {
        // Realiza la petición para mostrar el formulario de creación
        $response = $this->get(route('admin.productos.create'));

        // Verifica que la respuesta sea 200 y que la vista tenga categorías
        $response->assertStatus(200);
        $response->assertViewHas('categorias');
    }

    /** @test */
    public function it_stores_a_new_producto()
    {
        // Fake para almacenar imágenes
        Storage::fake('public');

        // Crear categoría de prueba
        $categoria = Categoria::factory()->create();
        $data = [
            'codigo' => 'PRD123',
            'nombre' => 'Producto de prueba',
            'stock' => 10,
            'descripcion' => 'Descripción de prueba',
            'stock_minimo' => 2,
            'stock_maximo' => 20,
            'precio_compra' => 100.50,
            'precio_venta' => 150.75,
            'fecha_ingreso' => now()->toDateString(),
            'categoria_id' => $categoria->id,
            'imagen' => UploadedFile::fake()->image('producto.jpg'),
        ];

        // Realiza la petición para guardar el producto
        $response = $this->post(route('admin.productos.store'), $data);

        // Verifica que el producto esté en la base de datos
        $this->assertDatabaseHas('productos', [
            'codigo' => 'PRD123',
            'nombre' => 'Producto de prueba',
        ]);

        // Verifica que la imagen esté almacenada
        Storage::disk('public')->assertExists('productos/' . $data['imagen']->hashName());

        // Verifica que se redirija correctamente
        $response->assertRedirect(route('admin.productos.index'));
    }

    /** @test */
    public function it_displays_a_single_producto()
    {
        // Crear producto de prueba
        $producto = Productos::factory()->create();

        // Realiza la petición para mostrar el producto
        $response = $this->get(route('admin.productos.show', $producto));

        // Verifica que el estado sea 200 y que el producto esté en la vista
        $response->assertStatus(200);
        $response->assertViewHas('producto', $producto);
    }

    /** @test */
    public function it_displays_the_edit_form()
    {
        // Crear producto de prueba
        $producto = Productos::factory()->create();

        // Realiza la petición para mostrar el formulario de edición
        $response = $this->get(route('admin.productos.edit', $producto));

        // Verifica que el estado sea 200 y que el producto esté en la vista
        $response->assertStatus(200);
        $response->assertViewHas('producto', $producto);
    }

    /** @test */
    public function it_updates_a_producto()
    {
        // Fake para almacenar imágenes
        Storage::fake('public');

        // Crear producto y categoría de prueba
        $producto = Productos::factory()->create();
        $categoria = Categoria::factory()->create();
        $data = [
            'codigo' => 'PRD456',
            'nombre' => 'Producto actualizado',
            'stock' => 20,
            'descripcion' => 'Nueva descripción',
            'stock_minimo' => 3,
            'stock_maximo' => 25,
            'precio_compra' => 200.75,
            'precio_venta' => 300.50,
            'fecha_ingreso' => now()->toDateString(),
            'categoria_id' => $categoria->id,
            'imagen' => UploadedFile::fake()->image('nuevo_producto.jpg'),
        ];

        // Realiza la petición para actualizar el producto
        $response = $this->put(route('admin.productos.update', $producto), $data);

        // Refresca el producto y verifica que los datos hayan sido actualizados
        $producto->refresh();
        $this->assertEquals('PRD456', $producto->codigo);

        // Verifica que la imagen esté almacenada
        Storage::disk('public')->assertExists('productos/' . $data['imagen']->hashName());

        // Verifica que se redirija correctamente
        $response->assertRedirect(route('admin.productos.index'));
    }

    /** @test */
    public function it_deletes_a_producto()
    {
        // Crear producto de prueba
        $producto = Productos::factory()->create();

        // Realiza la petición para eliminar el producto
        $response = $this->delete(route('admin.productos.destroy', $producto));

        // Verifica que el producto haya sido eliminado de la base de datos
        $this->assertDeleted($producto);

        // Verifica que se redirija correctamente
        $response->assertRedirect(route('admin.productos.index'));
    }
}
