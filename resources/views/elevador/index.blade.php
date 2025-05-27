<!DOCTYPE html>
<html>
<head>
    <title>Simulador de Elevador</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Elevador</h1>
    <p>Andar atual: <strong>{{ $andarAtual }}</strong></p>

    <form method="POST" action="{{ route('elevador.chamar') }}">
        @csrf
        <label for="andar">Chamar elevador para o andar:</label>
        <input type="number" name="andar" min="0" required>
        <button type="submit">Chamar</button>
    </form>

    <form method="POST" action="{{ route('elevador.mover') }}" style="margin-top: 10px;">
        @csrf
        <button type="submit">Mover elevador</button>
    </form>

    <h3>Fila de chamados:</h3>
    <ul>
        @forelse($fila as $andar)
            <li>Andar {{ $andar }}</li>
        @empty
            <li>Sem chamados pendentes</li>
        @endforelse
    </ul>
</body>
</html>
