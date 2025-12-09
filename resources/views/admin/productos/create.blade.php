<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear producto - Admin Nutri</title>
</head>
<body>
    <h1>Crear nuevo producto</h1>

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

    <form action="{{ route('admin.productos.store') }}" method="POST">
        @csrf

        <div>
            <label>Nombre:</label><br>
            <input type="text" name="nombre" value="{{ old('nombre') }}" required>
        </div>

        <div>
            <label>Descripción:</label><br>
            <textarea name="descripcion"></textarea>
        </div>

        <div>
            <label>Precio:</label><br>
            <input type="number" step="0.01" name="precio" value="{{ old('precio') }}" required>
        </div>

        <div>
            <label>Stock:</label><br>
            <input type="number" name="stock" value="{{ old('stock') }}" required>
        </div>

        <div>
            <label>Marca:</label><br>
            <input type="text" name="marca" value="{{ old('marca') }}" required>
        </div>

        <div>
            <label>Categoría:</label><br>
            <select name="categoria_id" required>
                <option value="">-- Selecciona una categoría --</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}"
                        {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>
        <button type="submit">Guardar</button>
        <a href="{{ route('admin.productos.index') }}">Cancelar</a>
    </form>
</body>
</html>
