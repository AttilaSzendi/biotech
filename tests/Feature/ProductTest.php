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

        $names = [
            'product_1',
            'product_2',
            'product_3',
        ];

        foreach ($names as $name) {
            factory(Product::class)->create(['name' => $name]);
        }

        $response = $this->get(route('products.index'));

        $response->assertSeeInOrder($names);

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

        $tagIds = $this->getTagIds();

        $input = [
            'name' => $this->faker->word,
            'description' => $this->faker->randomHtml(),
            'src' => $image,
            'price' => $this->faker->numberBetween(100, 1000),
            'tags' => $tagIds
        ];

        $response = $this->post(route('products.store'), $input);

        $this->assertDatabaseHas('products', [
            'name' => $input['name'],
            'price' => $input['price']
        ]);

        $this->assertProductHasTagged($tagIds);

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

        $tagIds = $this->getTagIds();

        $input = [
            'name' => 'új',
            'description' => $product->description,
            'price' => $product->price,
            'tags' => $tagIds
        ];

        $response = $this->put(route('products.update', $product->id), $input);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => $input['name'],
        ]);

        $this->assertProductHasTagged($tagIds);

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

    /**
     * @return array
     */
    public function getTagIds(): array
    {
        return factory(Tag::class, 2)->create()->pluck('id')->toArray();
    }

    /**
     * @param $tagIds
     */
    public function assertProductHasTagged($tagIds): void
    {
        $this->assertDatabaseHas('product_tag', [
            'product_id' => 1,
            'tag_id' => $tagIds[0]
        ]);

        $this->assertDatabaseHas('product_tag', [
            'product_id' => 1,
            'tag_id' => $tagIds[1]
        ]);
    }
}
