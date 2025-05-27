<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Elevador;
use Illuminate\Support\Facades\Session;
use App\Models\MovimentoElevador;

class ElevadorController extends Controller
{
    protected function getElevador(): Elevador
    {
        if (!Session::has('elevador')) {
            Session::put('elevador', serialize(new Elevador(5)));
        }

        return unserialize(Session::get('elevador'));
    }

    protected function saveElevador(Elevador $elevador): void
    {
        Session::put('elevador', serialize($elevador));
    }

    public function index()
    {
        $elevador = $this->getElevador();
        return view('elevador.index', [
            'andarAtual' => $elevador->getAndarAtual(),
            'fila' => iterator_to_array($elevador->getChamadosPendentes())
        ]);
    }

    public function chamar(Request $request)
    {
        $andar = (int) $request->input('andar');
        $elevador = $this->getElevador();
        $elevador->chamar($andar);
        
        MovimentoElevador::create([
            'acao' => 'chamar',
            'andar' => $andar
        ]);
        $this->saveElevador($elevador);
        return redirect()->route('elevador.index');
    }

    public function mover()
    {
        $elevador = $this->getElevador();
        $elevador->mover();

        MovimentoElevador::create([
            'acao' => 'mover',
            'andar' => $elevador->getAndarAtual()
        ]);
        $this->saveElevador($elevador);
        return redirect()->route('elevador.index');
    }
}
