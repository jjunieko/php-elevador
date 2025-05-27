<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\Elevador;
use Mockery;
use Illuminate\Contracts\Container\Container;

class TestarElevadorCommandTest extends TestCase
{
    public function testComandoElevadorTestarExecutaComMock()
    {
        $mock = Mockery::mock(Elevador::class);

        $mock->shouldReceive('chamar')->with(3)->once();
        $mock->shouldReceive('chamar')->with(5)->once();
        $mock->shouldReceive('chamar')->with(1)->once();

        $splQueue = new \SplQueue();
        $splQueue->enqueue(3);
        $splQueue->enqueue(5);
        $splQueue->enqueue(1);

        $mock->shouldReceive('getChamadosPendentes')
            ->once()
            ->andReturn(clone $splQueue);


        $mock->shouldReceive('mover')->times(4);

        $mock->shouldReceive('getAndarAtual')
            ->once()
            ->andReturn(1);

        $this->app->bind(Elevador::class, fn(Container $app) => $mock);

        $this->artisan('elevador:testar')
            ->expectsOutput('Chamados pendentes:')
            ->expectsOutput('- Andar 3')
            ->expectsOutput('- Andar 5')
            ->expectsOutput('- Andar 1')
            ->expectsOutput('Andar atual: 1')
            ->assertExitCode(0);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
