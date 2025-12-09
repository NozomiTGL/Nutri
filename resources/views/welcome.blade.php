<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Suplementos & Nutrición</title>
    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="text-gray-800 bg-gray-50">
    <!-- HERO SECTION -->
    <header class="relative flex items-center justify-center h-screen bg-center bg-cover" style="background-image: url('https://images.unsplash.com/photo-1554284126-aa88f22d8b54');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="relative z-10 max-w-2xl text-center text-white">
        <h1 class="mb-6 text-5xl font-extrabold drop-shadow-lg">Suplementos para tu mejor versión</h1>
        <p class="mb-8 text-lg">Encuentra productos, rutinas y recomendaciones diseñadas para tus objetivos de nutrición y rendimiento.</p>

        <div class="flex flex-col items-center gap-4 sm:flex-row sm:justify-center">
            <a href="#beneficios"
                class="px-8 py-3 font-semibold text-black transition bg-yellow-500 rounded-full shadow-xl hover:bg-yellow-600">
                Conoce nuestros beneficios
            </a>


            <a href="{{ route('login') }}"
            class="px-8 py-3 font-semibold text-white transition bg-indigo-600 rounded-full shadow-xl hover:bg-indigo-700">
                Iniciar sesión
            </a>
        </div>
    </div>

    </header>

    <!-- SECCIÓN DE BENEFICIOS -->
    <section class="py-20 bg-white" id="beneficios">
        <div class="max-w-6xl mx-auto mb-12 text-center">
            <h2 class="mb-4 text-4xl font-bold">Optimiza tu rendimiento</h2>
            <p class="text-lg text-gray-600">Todo lo que necesitas para complementar tus entrenamientos y estilo de vida saludable.</p>
        </div>

        <div class="grid max-w-6xl gap-10 px-6 mx-auto md:grid-cols-3">
            <div class="p-8 bg-white shadow-xl rounded-2xl">
                <img src="https://cdn-icons-png.flaticon.com/512/1048/1048943.png" class="w-20 mx-auto mb-4" />
                <h3 class="mb-2 text-xl font-semibold">Proteínas & Ganadores</h3>
                <p class="text-gray-600">Aumenta masa muscular y acelera tu recuperación.</p>
            </div>

            <div class="p-8 bg-white shadow-xl rounded-2xl">
                <img src="https://cdn-icons-png.flaticon.com/512/2965/2965567.png" class="w-20 mx-auto mb-4" />
                <h3 class="mb-2 text-xl font-semibold">Vitaminas & Salud</h3>
                <p class="text-gray-600">Refuerza tu sistema inmunológico y energía diaria.</p>
            </div>

            <div class="p-8 bg-white shadow-xl rounded-2xl">
                <img src="https://cdn-icons-png.flaticon.com/512/2965/2965571.png" class="w-20 mx-auto mb-4" />
                <h3 class="mb-2 text-xl font-semibold">Pre-entrenos & Rendimiento</h3>
                <p class="text-gray-600">Mejora fuerza, enfoque y resistencia en tus entrenamientos.</p>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="py-10 mt-20 text-gray-300 bg-gray-900">
        <div class="max-w-6xl mx-auto text-center">
            <p class="text-sm">© 2025 NutriFit — Suplementos, nutrición y bienestar.</p>
        </div>
    </footer>
</body>
</html>
