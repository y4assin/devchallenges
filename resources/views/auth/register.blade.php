<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.ico') }}">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800">Registro</h2>
        
        <form method="POST" action="{{ route('register') }}" class="mt-6">
            @csrf
            
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nombre</label>
                <input id="name" type="text" name="name" required autofocus class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Correo electrónico</label>
                <input id="email" type="email" name="email" required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Contraseña</label>
                <input id="password" type="password" name="password" required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700">Confirmar contraseña</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <button type="submit" class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg">Registrarse</button>
            
       
        </form>
        
        <p class="mt-4 text-center text-gray-600">¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Inicia sesión aquí</a></p>
    </div>
</body>
</html>
