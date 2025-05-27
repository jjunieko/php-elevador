<?php

namespace App\Services;

use SplQueue;

class Elevador
{
    protected SplQueue $filaChamados;
    protected int $andarAtual;
    protected int $capacidade;

    public function __construct(int $capacidade)
    {
        $this->filaChamados = new SplQueue();
        $this->andarAtual = 0;
        $this->capacidade = $capacidade;
    }

    public function chamar(int $andar): void
    {
        if ($andar >= 0) {
            $this->filaChamados->enqueue($andar);
            echo "Elevador chamado para o andar {$andar}.\n";
        } else {
            echo "Andar inválido: {$andar}\n";
        }
    }

    public function mover(): void
    {
        if ($this->filaChamados->isEmpty()) {
            echo "Não há chamados pendentes.\n";
            return;
        }

        $proximoAndar = $this->filaChamados->dequeue();
        echo "Movendo do andar {$this->andarAtual} para o andar {$proximoAndar}...\n";
        $this->andarAtual = $proximoAndar;
        echo "Elevador  chegou ao andar {$this->andarAtual}.\n";
    }

    public function getAndarAtual(): int
    {
        return $this->andarAtual;
    }

    public function getChamadosPendentes(): SplQueue
    {
        return clone $this->filaChamados;
    }
}
