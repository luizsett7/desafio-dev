<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Arquivo CNAB</title>
</head>
<body>
    <h1>Upload de Arquivo CNAB</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
        <p>Arquivo enviado: {{ session('file') }}</p>
    @endif

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="file">Escolha o arquivo CNAB (txt):</label>
        <input type="file" name="file" id="file" accept=".txt" required>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>