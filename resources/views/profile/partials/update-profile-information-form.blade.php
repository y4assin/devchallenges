<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Información del Perfil') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Actualiza la información de tu perfil y correo electrónico.') }}
        </p>
    </header>

    {{-- Eliminar o comentar este formulario si no necesitas verificación de email --}}
    {{-- <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form> --}}

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name">Nombre</label>
            <input id="name" name="name" type="text" class="mt-1 block w-full" 
                   value="{{ old('name', $user->name) }}" required autofocus />
            @error('name')
                <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="email">Email</label>
            <input id="email" name="email" type="email" class="mt-1 block w-full" 
                   value="{{ old('email', $user->email) }}" required />
            @error('email')
                <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit">Guardar</button>

            @if (session('status') === 'profile-updated')
                <p>{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section> 