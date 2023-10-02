<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\SquareRootController;
use Illuminate\Http\Request;

class SquareRootControllerTest extends TestCase
{
    public function testNegativeInput()
    {
        $response = $this->post('/calculate', [
            'number' => -5,
            'method' => 'API Service',
        ]);

        $response->assertRedirect()->assertSessionHas('error', 'Input harus berupa bilangan positif yang lebih besar dari 0.');
    }

    public function testNonNumericInput()
    {
        $response = $this->post('/calculate', [
            'number' => 'abc',
            'method' => 'API Service',
        ]);

        $response->assertRedirect()->assertSessionHas('error', 'Input harus berupa bilangan positif yang lebih besar dari 0.');
    }

    public function testLongInput()
    {
        $response = $this->post('/calculate', [
            'number' => '1234567',
            'method' => 'API Service',
        ]);

        $response->assertRedirect()->assertSessionHas('error', 'Panjang input terlalu panjang. Harap masukkan input yang lebih pendek.');
    }

    public function testValidInput()
    {
        $response = $this->post('/calculate', [
            'number' => 25,
            'method' => 'API Service',
        ]);

        $response->assertRedirect()->assertSessionMissing('error');
    }

    public function testCalculateMethodWithApiService()
    {
        // Skenario 1: Pengujian ketika metode adalah "API Service"
        $controller = new SquareRootController();

        $request = Request::create('/calculate', 'POST', ['number' => 16, 'method' => 'API Service']);

        $response = $controller->calculate($request);

        // Periksa apakah hasil perhitungan sesuai dengan yang diharapkan
        $this->assertEquals(4, $response->getSession()->get('result'));
    }

    public function testCalculateMethodWithPlSql()
    {
        // Skenario 2: Pengujian ketika metode adalah "PL/SQL"
        $controller = new SquareRootController();

        $request = Request::create('/calculate', 'POST', ['number' => 25, 'method' => 'PL/SQL']);

        $response = $controller->calculate($request);

        // Periksa apakah hasil perhitungan sesuai dengan yang diharapkan
        $this->assertEquals(5, $response->getSession()->get('result'));
    }
}
