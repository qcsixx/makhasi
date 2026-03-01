<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Makanan;
use App\Models\Daerah;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MenuControllerTest extends TestCase
{
    use RefreshDatabase;

    protected Daerah $daerah;

    protected function setUp(): void
    {
        parent::setUp();

        $this->daerah = Daerah::factory()->create(['nama' => 'Jawa']);
    }

    public function test_menu_page_loads_successfully(): void
    {
        $response = $this->get(route('menu'));

        $response->assertStatus(200);
        $response->assertViewIs('menu');
    }

    public function test_menu_displays_published_foods(): void
    {
        $publishedFood = Makanan::factory()->create([
            'nama' => 'Nasi Goreng',
            'status' => 'published',
            'daerah_id' => $this->daerah->id,
        ]);

        $draftFood = Makanan::factory()->create([
            'nama' => 'Rendang',
            'status' => 'draft',
            'daerah_id' => $this->daerah->id,
        ]);

        $response = $this->get(route('menu'));

        $response->assertSee('Nasi Goreng');
        $response->assertDontSee('Rendang');
    }

    public function test_menu_search_works(): void
    {
        Makanan::factory()->create([
            'nama' => 'Nasi Goreng',
            'status' => 'published',
            'daerah_id' => $this->daerah->id,
        ]);

        Makanan::factory()->create([
            'nama' => 'Sate Ayam',
            'status' => 'published',
            'daerah_id' => $this->daerah->id,
        ]);

        $response = $this->get(route('menu', ['search' => 'Nasi']));

        $response->assertSee('Nasi Goreng');
        $response->assertDontSee('Sate Ayam');
    }

    public function test_menu_filter_by_region_works(): void
    {
        $daerahSumatra = Daerah::factory()->create(['nama' => 'Sumatra']);

        Makanan::factory()->create([
            'nama' => 'Nasi Goreng',
            'status' => 'published',
            'daerah_id' => $this->daerah->id,
        ]);

        Makanan::factory()->create([
            'nama' => 'Rendang',
            'status' => 'published',
            'daerah_id' => $daerahSumatra->id,
        ]);

        $response = $this->get(route('menu', ['daerah' => $this->daerah->id]));

        $response->assertSee('Nasi Goreng');
        $response->assertDontSee('Rendang');
    }

    public function test_menu_pagination_works(): void
    {
        Makanan::factory()->count(15)->create([
            'status' => 'published',
            'daerah_id' => $this->daerah->id,
        ]);

        $response = $this->get(route('menu'));

        $response->assertStatus(200);
        // Should show pagination links
        $response->assertSee('pagination');
    }

    public function test_food_detail_page_loads(): void
    {
        $makanan = Makanan::factory()->create([
            'nama' => 'Nasi Goreng',
            'daerah_id' => $this->daerah->id,
        ]);

        $response = $this->get(route('detail', $makanan->id));

        $response->assertStatus(200);
        $response->assertViewIs('detail');
        $response->assertSee('Nasi Goreng');
    }

    public function test_food_detail_shows_404_for_invalid_id(): void
    {
        $response = $this->get(route('detail', 99999));

        $response->assertStatus(404);
    }
}
