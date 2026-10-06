<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Ticket</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f3f4f6; }
        .card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); max-width: 500px; margin: 0 auto; }
        .form-group { margin-bottom: 15px; }
        label { font-weight: bold; display: block; margin-bottom: 5px; }
        input[type="text"], textarea { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        textarea { height: 100px; }
        .error { color: #dc2626; font-size: 13px; margin-top: 5px; }
        button { background-color: #2563eb; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 15px; }
        button:hover { background-color: #1d4ed8; }
        .back-link { display: inline-block; margin-top: 15px; color: #4b5563; text-decoration: none; }
    </style>
</head>
<body>

<div class="card">
    <h2>Nuevo Ticket</h2>
    
    <form method="POST" action="{{ route('tickets.store') }}">
        @csrf

        <div class="form-group">
            <label>Título</label>
            <input type="text" name="titulo" value="{{ old('titulo') }}">
            @error('titulo')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>Descripción</label>
            <textarea name="descripcion">{{ old('descripcion') }}</textarea>
            @error('descripcion')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Crear ticket</button>
    </form>

    <a href="{{ route('tickets.index') }}" class="back-link">⬅ Volver al listado</a>
</div>

</body>
</html>
