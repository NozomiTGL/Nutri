<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar producto - Admin Nutri</title>
</head>
<body>
    <h1>Editar producto: {{ $producto->nombre }}</h1>

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

    <form action="{{ route('admin.productos.update', $producto) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Nombre:</label><br>
            <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required>
        </div>

        <div>
            <label>Descripción:</label><br>
            <textarea name="descripcion">{{ old('descripcion', $producto->descripcion) }}</textarea>
        </div>

        <div>
            <label>Precio:</label><br>
            <input type="number" step="0.01" name="precio" value="{{ old('precio', $producto->precio) }}" required>
        </div>

        <div>
            <label>Stock:</label><br>
            <input type="number" name="stock" value="{{ old('stock', $producto->stock) }}" required>
        </div>

        <div>
            <label>Marca:</label><br>
            <input type="text" name="marca" value="{{ old('marca', $producto->marca) }}" required>
        </div>

        <div>
            <label>Categoría:</label><br>
            <select name="categoria_id" required>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}"
                        {{ old('categoria_id', $producto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>
        <button type="submit">Actualizar</button>
        <a href="{{ route('admin.productos.index') }}">Cancelar</a>
    </form>
</body>
</html>
