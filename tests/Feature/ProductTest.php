<?php

namespace Tests\Feature;

use App\Product;
use App\Tag;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function products_can_be_listed()
    {
        $this->login();

        $name = 'teszt 1';

        factory(Product::class, 10)->create(['name' => $name]);

        $response = $this->get(route('products.index'));

        $response->assertSee($name);

        $response->assertOk();
    }

    /**
     * @test
     */
    public function a_product_create_form_can_be_reached()
    {
        $this->login();

        $response = $this->get(route('products.create'));

        $response->assertOk();
    }

    /**
     * @test
     */
    public function a_product_can_be_stored()
    {
        $this->login();

        Storage::fake('public');
        $image = UploadedFile::fake()->image('test.jpg');

        $input = [
            'name' => $this->faker->word,
            'description' => $this->faker->randomHtml(),
            'src' => $image,
            'price' => $this->faker->numberBetween(100, 1000)
        ];

        $response = $this->post(route('products.store'), $input);

        $this->assertDatabaseHas('products', [
            'name' => $input['name'],
            'price' => $input['price']
        ]);

        $response->assertRedirect(route('products.index'));
    }

    /**
     * @test
     */
    public function a_product_edit_form_can_be_reached()
    {
        $this->login();

        $tag = factory(Product::class)->create();

        $response = $this->get(route('products.edit', $tag->id));

        $response->assertOk();
    }

    /**
     * @test
     */
    public function a_product_can_be_updated()
    {
        $this->login();

        $product = factory(Product::class)->create();

        $input = [
            'name' => 'új',
            'description' => $product->description,
            'price' => $product->price
        ];

        $response = $this->put(route('products.update', $product->id), $input);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => $input['name'],
        ]);

        $response->assertRedirect(route('products.index'));
    }

    /**
     * @test
     */
    public function a_product_can_be_deleted()
    {
        $this->login();

        $product = factory(Product::class)->create();

        $response = $this->delete(route('products.destroy', $product->id));

        $this->assertDatabaseMissing('products', ['id' => $product->id]);

        $response->assertRedirect(route('products.index'));
    }

    protected function login(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);
    }
}
