<?php

use App\Http\Controllers\SocialLiteAuthController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\ShoppingListController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');


// Llistes de compra
Route::middleware(['auth'])->group(function () {
    Route::get('/shopping-lists', [ShoppingListController::class, 'index'])->name('shopping-lists.index');
    Route::get('/shopping-lists/create', [ShoppingListController::class, 'create'])->name('shopping-lists.create');
    Route::post('/shopping-lists', [ShoppingListController::class, 'store'])->name('shopping-lists.store');
    Route::get('/shopping-lists/{id}', [ShoppingListController::class, 'show'])->name('shopping-lists.show');

    // Categories
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

    // Productes
    Route::post('/products', [ProductController::class, 'store'])->name('products.store'); // Ruta para almacenar nuevos productos
    Route::post('/products/{id}/toggle', [ProductController::class, 'toggleCompleted'])->name('products.toggle');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update'); // Ruta para actualizar productos
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy'); // Ruta para eliminar productos

});

// Parte de GOOGLE
Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/google-auth/callback', function () {
    $user_google = Socialite::driver('google')->stateless()->user(); // Añade stateless()

    $existingUser = User::where('email', $user_google->email)->first();

    if ($existingUser) {
        Auth::login($existingUser);
        return redirect('/dashboard');
    }

    $user = User::create([
        'name' => $user_google->name,
        'email' => $user_google->email,
        'password' => bcrypt(Str::random(12)),
    ]);

    Auth::login($user);

    return redirect('/dashboard');
});






// LOGIN CON GITHUB
/*
Route::get('/github-auth/redirect', function () {
    return Socialite::driver('github')->redirect();

});

Route::get('/github-auth/callback', function () {
    $user_github = Socialite::driver('github')->stateless()->user();

    $existingUser = User::where('email', $user_github->email)->first();

    if ($existingUser) {
        Auth::login($existingUser);
    } else {
        $user = User::create([
            'name' => $user_github->name,
            'email' => $user_github->email,
            'password' => bcrypt(\Illuminate\Support\Str::random(12)),
        ]);

        Auth::login($user);
    }

    session(['logged_in' => true]); // Guardamos una variable en la sesión
    return redirect('/dashboard');
});
*/
Route::get('github-auth/redirect', [SocialLiteAuthController::class, 'index']);
Route::get('github-auth/callback', [SocialLiteAuthController::class, 'store']);


// Remover el dashboard del grupo de middleware auth
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Mantener otras rutas que requieran autenticación en el grupo
Route::middleware(['auth'])->group(function () {
});
