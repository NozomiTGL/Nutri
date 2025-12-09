<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Categorías - Admin Nutri</title>
</head>
<body>
    <h1>Listado de categorías</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <p>
        <a href="{{ route('admin.categorias.create') }}">+ Crear nueva categoría</a>
    </p>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse($categorias as $categoria)
            <tr>
                <td>{{ $categoria->id }}</td>
                <td>{{ $categoria->nombre }}</td>
                <td>{{ $categoria->descripcion }}</td>
                <td>
                    <a href="{{ route('admin.categorias.edit', $categoria) }}">Editar</a>

                    <form action="{{ route('admin.categorias.destroy', $categoria) }}"
                          method="POST"
                          style="display:inline-block"
                          onsubmit="return confirm('¿Seguro que deseas eliminar esta categoría?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No hay categorías registradas.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <p>
        <a href="{{ route('admin.dashboard') }}">Volver al panel</a>
    </p>
</body>
</html>
