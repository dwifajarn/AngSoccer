<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthLoginMessagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_specific_error_when_email_is_not_registered(): void
    {
        $response = $this->post('/login', [
            'email' => 'unregistered@example.com',
            'password' => 'secret123',
        ]);

        $response->assertSessionHasErrors([
            'email' => 'Email ini belum terdaftar. Silakan periksa kembali atau buat akun baru.',
        ]);
    }

    public function test_shows_specific_error_when_password_is_wrong(): void
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '081234567890',
            'password' => Hash::make('correctpassword'),
            'role' => 'user',
        ]);

        $response = $this->post('/login', [
            'email' => 'john@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors([
            'password' => 'Kata sandi yang Anda masukkan salah. Silakan coba lagi atau gunakan Lupa Password.',
        ]);
    }
}
