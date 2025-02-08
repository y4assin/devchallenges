<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.ico') }}">
    </head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800">Iniciar sesión</h2>
        
        <form method="POST" action="{{ route('login') }}" class="mt-6">
            @csrf
            
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Correo electrónico</label>
                <input id="email" type="email" name="email" required autofocus class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Contraseña</label>
                <input id="password" type="password" name="password" required class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-2">
                    <span class="text-gray-700 text-sm">Recuérdame</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-blue-500 text-sm hover:underline">¿Olvidaste tu contraseña?</a>
            </div>
            
            <button type="submit" class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg">Iniciar sesión</button>
            
            <div class="mt-4 text-center">
            <a href="/google-auth/redirect" class="flex items-center justify-center w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-lg mt-2">
    <img src="{{ asset('images/google.svg') }}" alt="Google Logo" class="w-5 h-5 mr-2"> Iniciar con Google
</a>
<a href="/github-auth/redirect" class="flex items-center justify-center w-full bg-black hover:bg-gray-900 text-white font-bold py-3 rounded-lg mt-2">
   <img src="{{ asset('images/github-dark.svg') }}" alt="Github Logo" class="w-5 h-5 mr-3"> Iniciar con Github
            </a>
        </div>
        </form>
        
        <p class="mt-4 text-center text-gray-600">¿No tienes cuenta? <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Regístrate aquí</a></p>
    </div>
</body>
</html>