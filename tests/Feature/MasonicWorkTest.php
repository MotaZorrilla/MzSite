<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\MasonicWork;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Http\Middleware\VerifyCsrfToken;

class MasonicWorkTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    protected function setUp(): void
    {
        parent::setUp();
        // Disable CSRF for all tests in this class
        $this->withoutMiddleware(VerifyCsrfToken::class);
    }

    /**
     * Test that the masonry page loads successfully and contains works.
     */
    public function test_masonry_page_can_be_rendered_with_works(): void
    {
        // Create some dummy works
        MasonicWork::factory()->count(3)->create();

        $response = $this->get('/masonry');

        $response->assertStatus(200);
        $response->assertViewIs('masonry');
        $response->assertViewHas('works');
        $response->assertSee('Repositorio de Obras'); // Check for a key text on the page
    }

    /**
     * Test that an authenticated user can upload a masonic work.
     */
    public function test_authenticated_user_can_upload_masonic_work(): void
    {
        Storage::fake('local'); // Use a fake disk for testing file uploads

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('masonry.store'), [
            'title' => 'Test Masonic Work',
            'file' => UploadedFile::fake()->create('document.pdf', 100, 'application/pdf'),
            'is_public' => true,
        ]);

        $response->assertRedirect(route('masonry.index'));
        $this->assertDatabaseHas('masonic_works', [
            'title' => 'Test Masonic Work',
            'is_public' => true,
        ]);

        // Assert the file was stored
        $masonicWork = MasonicWork::where('title', 'Test Masonic Work')->first();
        Storage::disk('local')->assertExists($masonicWork->file_path);
    }

    /**
     * Test that an unauthenticated user cannot upload a masonic work.
     */
    public function test_unauthenticated_user_cannot_upload_masonic_work(): void
    {
        $response = $this->post(route('masonry.store'), [
            'title' => 'Unauthorized Work',
            'file' => UploadedFile::fake()->create('unauth.pdf', 100, 'application/pdf'),
            'is_public' => true,
        ]);

        $response->assertRedirect('/login'); // Should redirect to login
        $this->assertDatabaseMissing('masonic_works', [
            'title' => 'Unauthorized Work',
        ]);
    }

    /**
     * Test validation for masonic work upload.
     */
    public function test_masonic_work_upload_validation(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('masonry.store'), [
            'title' => '', // Missing title
            'file' => '', // Missing file
        ]);

        $response->assertSessionHasErrors(['title', 'file']);
    }
}