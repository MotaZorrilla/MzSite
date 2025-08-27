<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;

class AuthModalsTest extends TestCase
{
    use RefreshDatabase; // Resets the database for each test

    /** @test */
    public function login_modal_can_be_opened_and_user_can_login()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        Livewire::test('login-modal')
            ->call('showModal')
            ->assertSet('showModal', true)
            ->set('email', 'test@example.com')
            ->set('password', 'password')
            ->call('login')
            ->assertRedirect('/masonry'); // Assuming 'masonry' is the intended redirect after login
    }

    /** @test */
    public function registration_modal_can_be_opened_and_new_user_can_register()
    {
        Livewire::test('register-modal')
            ->call('showModal')
            ->assertSet('showModal', true)
            ->set('name', 'Test User')
            ->set('email', 'newuser@example.com')
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->call('register')
            ->assertDispatched('show-login-modal'); // Check if login modal is dispatched after registration

        $this->assertDatabaseHas('users', [
            'email' => 'newuser@example.com',
            'name' => 'Test User',
            'degree' => 'Aprendiz', // Default degree
        ]);
    }

    /** @test */
    public function login_form_shows_validation_errors()
    {
        Livewire::test('login-modal')
            ->call('showModal')
            ->set('email', 'invalid-email')
            ->set('password', 'short')
            ->call('login')
            ->assertHasErrors(['email', 'password']);
    }

    /** @test */
    public function registration_form_shows_validation_errors()
    {
        Livewire::test('register-modal')
            ->call('showModal')
            ->set('name', '')
            ->set('email', 'invalid-email')
            ->set('password', 'short')
            ->set('password_confirmation', 'mismatch')
            ->call('register')
            ->assertHasErrors(['name', 'email', 'password']);
    }

    /** @test */
    public function registration_form_prevents_duplicate_email()
    {
        User::factory()->create([
            'email' => 'existing@example.com',
        ]);

        Livewire::test('register-modal')
            ->call('showModal')
            ->set('name', 'Another User')
            ->set('email', 'existing@example.com')
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->call('register')
            ->assertHasErrors(['email']);
    }
}
