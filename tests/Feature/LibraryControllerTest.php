<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Makanan;
use App\Models\Library;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LibraryControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Makanan $makanan;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->makanan = Makanan::factory()->create();
    }

    public function test_user_can_view_library_page(): void
    {
        $response = $this->actingAs($this->user)->get(route('library'));

        $response->assertStatus(200);
        $response->assertViewIs('library');
    }

    public function test_user_can_add_food_to_library(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('library.add'), [
                'makanan_id' => $this->makanan->id,
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('library', [
            'user_id' => $this->user->id,
            'makanan_id' => $this->makanan->id,
        ]);
    }

    public function test_user_cannot_add_duplicate_to_library(): void
    {
        // Add once
        Library::create([
            'user_id' => $this->user->id,
            'makanan_id' => $this->makanan->id,
        ]);

        // Try to add again
        $response = $this->actingAs($this->user)
            ->post(route('library.add'), [
                'makanan_id' => $this->makanan->id,
            ]);

        $response->assertRedirect();

        // Should still only have one entry
        $this->assertEquals(1, Library::where('user_id', $this->user->id)
            ->where('makanan_id', $this->makanan->id)
            ->count());
    }

    public function test_user_can_remove_food_from_library(): void
    {
        Library::create([
            'user_id' => $this->user->id,
            'makanan_id' => $this->makanan->id,
        ]);

        $response = $this->actingAs($this->user)
            ->delete(route('library.remove', $this->makanan->id));

        $response->assertRedirect();
        $this->assertDatabaseMissing('library', [
            'user_id' => $this->user->id,
            'makanan_id' => $this->makanan->id,
        ]);
    }

    public function test_guest_cannot_access_library(): void
    {
        $response = $this->get(route('library'));
        $response->assertRedirect(route('login'));
    }

    public function test_library_shows_only_user_items(): void
    {
        $otherUser = User::factory()->create();
        $otherMakanan = Makanan::factory()->create();

        // Add to current user's library
        Library::create([
            'user_id' => $this->user->id,
            'makanan_id' => $this->makanan->id,
        ]);

        // Add to other user's library
        Library::create([
            'user_id' => $otherUser->id,
            'makanan_id' => $otherMakanan->id,
        ]);

        $response = $this->actingAs($this->user)->get(route('library'));

        $response->assertStatus(200);
        $response->assertSee($this->makanan->nama);
        $response->assertDontSee($otherMakanan->nama);
    }
}
