<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\MovimentoElevador;
use App\Services\Elevador;

class ElevadorControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexExibeAndarAtualEFila()
    {
        $elevador = new Elevador(5);
        $elevador->chamar(3);
        $elevador->chamar(4);

        Session::put('elevador', serialize($elevador));

        $response = $this->get('/elevador');

        $response->assertStatus(200);
        $response->assertViewIs('elevador.index');
        $response->assertViewHas('andarAtual', 0);
        $response->assertViewHas('fila', [3, 4]);
    }

    public function testChamarAdicionaNaFilaESalvaNoBanco()
    {
        $response = $this->post('/elevador/chamar', ['andar' => 2]);

        $response->assertRedirect('/elevador');

        $this->assertDatabaseHas('movimentos_elevador', [
            'acao' => 'chamar',
            'andar' => 2
        ]);
    }

    public function testMoverExecutaMovimentoESalvaNoBanco()
    {
        $elevador = new Elevador(5);
        $elevador->chamar(7);
        Session::put('elevador', serialize($elevador));

        $response = $this->post('/elevador/mover');
        $response->assertRedirect('/elevador');

        $this->assertDatabaseHas('movimentos_elevador', [
            'acao' => 'mover',
            'andar' => 7
        ]);
    }
}
