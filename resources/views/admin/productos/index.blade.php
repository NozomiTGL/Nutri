<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos - Admin Nutri</title>
</head>
<body>
    <h1>Listado de productos</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <p>
        <a href="{{ route('admin.productos.create') }}">+ Crear nuevo producto</a>
    </p>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                <td>${{ number_format($producto->precio, 2) }}</td>
                <td>{{ $producto->stock }}</td>
                <td>
                    <a href="{{ route('admin.productos.edit', $producto) }}">Editar</a>

                    <form action="{{ route('admin.productos.destroy', $producto) }}"
                          method="POST"
                          style="display:inline-block"
                          onsubmit="return confirm('¿Seguro que deseas eliminar este producto?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">No hay productos registrados.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <p>
        <a href="{{ route('admin.dashboard') }}">Volver al panel</a>
    </p>
</body>
</html>
