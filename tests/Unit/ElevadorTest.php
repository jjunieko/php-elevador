<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\Elevador;

class ElevadorTest extends TestCase
{
    public function testElevadorIniciaNoTerreo()
    {
        $elevador = new Elevador(5);
        $this->assertEquals(0, $elevador->getAndarAtual());
    }

    public function testChamarAdicionaAndarNaFila()
    {
        $elevador = new Elevador(5);
        $elevador->chamar(3);

        $fila = $elevador->getChamadosPendentes();
        $this->assertFalse($fila->isEmpty());
        $this->assertEquals(3, $fila->dequeue());
    }

    public function testMoverAtualizaAndarAtual()
    {
        $elevador = new Elevador(5);
        $elevador->chamar(2);
        $elevador->mover();

        $this->assertEquals(2, $elevador->getAndarAtual());
    }

    public function testMoverSemChamadosMantemAndar()
    {
        $elevador = new Elevador(5);
        $elevador->mover();

        $this->assertEquals(0, $elevador->getAndarAtual());
    }

    public function testChamarAndarNegativoNaoAlteraFila()
    {
        $elevador = new Elevador(5);
        $elevador->chamar(-1);

        $fila = $elevador->getChamadosPendentes();
        $this->assertTrue($fila->isEmpty());
    }
}
