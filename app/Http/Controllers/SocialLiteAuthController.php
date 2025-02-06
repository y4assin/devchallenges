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

        // 2️⃣ Buscar usuario con este proveedor específico (GitHub)
        $user = User::whereHas('auth_providers', function ($query) use ($providerUser) {
            $query->where('provider', 'github')->where('provider_id', $providerUser->getId());
        })->first();

        if (!$user) {
            // 3️⃣ Buscar si el email ya existe en la base de datos
            $existingUser = User::where('email', $providerUser->getEmail())->first();

            if ($existingUser) {
                // 🚨 Si el usuario ya existe con Google, lo bloqueamos
                if ($existingUser->auth_providers()->where('provider', 'google')->exists()) {
                    return redirect('/login')->withErrors([
                        'error' => 'Este email ya está registrado con Google. Usa Google para iniciar sesión.',
                    ]);
                }

                // ⚠️ Si existe en la base de datos pero no tiene GitHub, lo asociamos
                $user = $existingUser;
            } else {
                // 4️⃣ Si el usuario no existe en la base de datos, lo creamos
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $name,
                    'password' => bcrypt(\Illuminate\Support\Str::random(12)),
                    'email_verified_at' => now(),
                ]);
            }
        }

        // 5️⃣ Asociamos este usuario con GitHub en la tabla de auth_providers
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

        // 6️⃣ Iniciar sesión con este usuario de GitHub
        Auth::login($user);

        return redirect('/dashboard');

    } catch (\Exception $e) {
        return redirect('/login')->withErrors(['error' => 'Error en la autenticación con GitHub: ' . $e->getMessage()]);
    }
}



}
