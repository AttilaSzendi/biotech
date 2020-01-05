<?php

namespace Tests\Feature;

use App\Tag;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function tags_can_be_listed()
    {
        $this->login();

        $tagName = 'akciós';

        factory(Tag::class, 10)->create(['name' => $tagName]);

        $response = $this->get(route('tags.index'));

        $response->assertSee($tagName);

        $response->assertOk();
    }

    /**
     * @test
     */
    public function a_tag_create_form_can_be_reached()
    {
        $this->login();

        $response = $this->get(route('tags.create'));

        $response->assertOk();
    }

    /**
     * @test
     */
    public function a_tag_can_be_stored()
    {
        $this->login();

        $input = ['name' => 'akciós'];

        $response = $this->post(route('tags.store'), $input);

        $this->assertDatabaseHas('tags', $input);

        $response->assertRedirect(route('tags.index'));
    }

    /**
     * @test
     */
    public function a_tag_edit_form_can_be_reached()
    {
        $this->login();

        $tag = factory(Tag::class)->create();

        $response = $this->get(route('tags.edit', $tag->id));

        $response->assertOk();
    }

    /**
     * @test
     */
    public function a_tag_can_be_updated()
    {
        $this->login();

        $tag = factory(Tag::class)->create();

        $input = ['name' => 'új'];

        $response = $this->put(route('tags.update', $tag->id), $input);

        $this->assertDatabaseHas('tags', [
            'id' => $tag->id,
            'name' => $input['name']
        ]);

        $response->assertRedirect(route('tags.index'));
    }

    /**
     * @test
     */
    public function a_tag_can_be_deleted()
    {
        $this->login();

        $tag = factory(Tag::class)->create();

        $response = $this->delete(route('tags.destroy', $tag->id));

        $this->assertDatabaseMissing('tags', ['id' => $tag->id]);

        $response->assertRedirect(route('tags.index'));
    }

    protected function login(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);
    }
}
