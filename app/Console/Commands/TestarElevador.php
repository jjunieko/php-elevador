<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Elevador;
use Illuminate\Contracts\Container\Container;

class TestarElevador extends Command
{
    protected $signature = 'elevador:testar';
    protected $description = 'Testa o funcionamento da classe Elevador';

    public function handle(Container $container): int
    {
        $elevador = $container->make(Elevador::class, ['capacidade' => 5]);

        $elevador->chamar(3);
        $elevador->chamar(5);
        $elevador->chamar(1);

        $this->info("Chamados pendentes:");
        foreach ($elevador->getChamadosPendentes() as $andar) {
            $this->line("- Andar {$andar}");
        }

        $elevador->mover();
        $elevador->mover();
        $elevador->mover();
        $elevador->mover(); // sem chamados

        $this->info("Andar atual: " . $elevador->getAndarAtual());

        return Command::SUCCESS;
    }
}

