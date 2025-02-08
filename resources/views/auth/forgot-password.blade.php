<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.ico') }}">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-md">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-900">Recuperar contraseña</h2>
            <p class="mt-2 text-sm text-gray-600">Ingresa tu correo y te enviaremos un enlace para restablecer tu contraseña.</p>
        </div>
        
        <form method="POST" action="{{ route('password.email') }}" class="mt-6">
            @csrf
            
            <div>
                <label for="email" class="block text-gray-700">Correo Electrónico</label>
                <input id="email" type="email" name="email" required autofocus class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="mt-6">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg transition">
                    Enviar enlace de recuperación
                </button>
            </div>
        </form>
        
        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Volver al inicio de sesión</a>
        </div>
    </div>
</body>
</html>
