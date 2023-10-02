<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SquareRootTest extends TestCase
{
    public function testSquareRootOfZero()
    {
        $response = $this->post('/calculate', [
            'number' => 0,
            'method' => 'API Service', // Gantilah dengan metode yang sesuai
        ]);

        // Mengikuti redirect
        $response->assertStatus(302); // Pastikan respons HTTP adalah 302 (Redirect)
        $response = $this->get($response->headers->get('Location')); // Ikuti redirect ke lokasi yang ditentukan

        // Sekarang verifikasi bahwa Anda berada di halaman yang benar
        $response->assertStatus(200) // Pastikan respons HTTP adalah 200 (OK)
                 ->assertSee('Input harus berupa bilangan positif yang lebih besar dari 0.'); // Verifikasi bahwa hasilnya adalah 0
    }
}
