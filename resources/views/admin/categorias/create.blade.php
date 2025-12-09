<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear categoría - Admin Nutri</title>
</head>
<body>
    <h1>Crear nueva categoría</h1>

    @if ($errors->any())
        <div style="color: red;">
            <strong>Revisa los errores:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.categorias.store') }}" method="POST">
        @csrf

        <div>
            <label>Nombre:</label><br>
            <input type="text" name="nombre" value="{{ old('nombre') }}" required>
        </div>

        <div>
            <label>Descripción:</label><br>
            <textarea name="descripcion">{{ old('descripcion') }}</textarea>
        </div>

        <br>
        <button type="submit">Guardar</button>
        <a href="{{ route('admin.categorias.index') }}">Cancelar</a>
    </form>
</body>
</html>
