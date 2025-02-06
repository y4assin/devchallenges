<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Auth_providers;
use Illuminate\Support\Facades\Auth;
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
        $providerUser = Socialite::driver('github')->stateless()->user(); // Añadir stateless()

        // Buscar usuario en la base de datos
        $user = User::where('email', $providerUser->getEmail())->first();

        if (!$user) {
            // Si no existe, crearlo
            $user = User::create([
                'email' => $providerUser->getEmail(),
                'name' => $providerUser->getName(),
            ]);
        }

        // Asociar el proveedor de autenticación con el usuario
        Auth_providers::updateOrCreate(
            [
                'user_id' => $user->id,
                'provider' => 'github',
            ],
            [
                'provider_id' => $providerUser->getId(),
                'avatar' => $providerUser->getAvatar(),
                'token' => $providerUser->token,
                'nickname' => $providerUser->getNickname(),
                'login_at' => Carbon::now(),
            ]
        );

        // Iniciar sesión en Laravel
        Auth::login($user);

        // Debug para verificar si Laravel mantiene la sesión
        dd(Auth::user());

        return redirect('/dashboard');

    } catch (\Exception $e) {
        return redirect('/login')->withErrors(['error' => 'Error en la autenticación con GitHub: ' . $e->getMessage()]);
    }
}

}
