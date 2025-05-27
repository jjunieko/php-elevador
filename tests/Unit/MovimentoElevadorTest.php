<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\MovimentoElevador;

class MovimentoElevadorTest extends TestCase
{
    use RefreshDatabase;

    public function testPodeCriarMovimentoElevador()
    {
        $movimento = MovimentoElevador::create([
            'acao' => 'chamar',
            'andar' => 4
        ]);

        $this->assertDatabaseHas('movimentos_elevador', [
            'acao' => 'chamar',
            'andar' => 4
        ]);

        $this->assertEquals('chamar', $movimento->acao);
        $this->assertEquals(4, $movimento->andar);
    }

    public function testTabelaPersonalizadaEstaCorreta()
    {
        $this->assertEquals('movimentos_elevador', (new MovimentoElevador)->getTable());
    }
}
