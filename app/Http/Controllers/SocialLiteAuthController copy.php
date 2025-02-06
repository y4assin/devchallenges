<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Auth_providers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SocialLiteAuthController extends Controller
{
    /**
     * Redirige al usuario a GitHub para autenticarse.
     */
    public function index()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Maneja la respuesta de GitHub y autentica al usuario en Laravel.
     */


     public function store()
{
    try {
        $providerUser = Socialite::driver('github')->stateless()->user();

        // 1️⃣ Asegurar que siempre haya un nombre
        $name = $providerUser->getName() ?? $providerUser->getNickname() ?? 'Usuario de GitHub';

        // 2️⃣ Verificar si el usuario ya existe con GitHub
        $user = User::whereHas('auth_providers', function ($query) use ($providerUser) {
            $query->where('provider', 'github')->where('provider_id', $providerUser->getId());
        })->first();

        if (!$user) {
            // 3️⃣ Si no existe, verificar si ya existe con el mismo email
            $user = User::where('email', $providerUser->getEmail())->first();

            if (!$user) {
                // 4️⃣ Si no existe, creamos un nuevo usuario con GitHub
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $name, // Ahora el nombre siempre tendrá un valor
                    'password' => bcrypt(\Illuminate\Support\Str::random(12)),
                    'email_verified_at' => now(),
                ]);
            }
        }

        // 5️⃣ Guardamos la autenticación de GitHub
        Auth_providers::updateOrCreate(
            [
                'user_id' => $user->id,
                'provider' => 'github',
            ],
            [
                'provider_id' => $providerUser->getId(),
                'avatar' => $providerUser->getAvatar(),
                'token' => $providerUser->token ?? null,
                'nickname' => $providerUser->getNickname() ?? '',
                'login_at' => now(),
            ]
        );

        // 6️⃣ Iniciar sesión con el usuario correcto
        Auth::login($user);

        return redirect('/dashboard');

    } catch (\Exception $e) {
        return redirect('/login')->withErrors(['error' => 'Error en la autenticación con GitHub: ' . $e->getMessage()]);
    }
}


}
