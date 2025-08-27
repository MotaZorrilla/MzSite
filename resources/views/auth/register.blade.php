<x-guest-layout>
    <div class="text-center mb-4">
        <a href="{{ route('masonry.index') }}" class="d-flex align-items-center justify-content-center mb-2 w-100">
            <img src="{{ asset('images/MotaZorrilla.png') }}" alt="MotaZorrilla Logo" style="max-height: 35px;">
        </a>
        <h2 class="text-light">Archivo Masónico</h2>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="form-group mb-3">
            <label for="name">Nombre</label>
            <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
            @error('name')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="form-group mb-3">
            <label for="email">Correo Electrónico</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
            @error('email')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group mb-3">
            <label for="password">Contraseña</label>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
            @error('password')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="form-group mb-3">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
            @error('password_confirmation')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <a class="text-sm" href="{{ route('login') }}">
                ¿Ya estás registrado?
            </a>

            <button type="submit" class="btn btn-primary">
                Registrarse
            </button>
        </div>

        <div class="text-center mt-4">
            <a class="text-sm" href="{{ route('masonry.index') }}">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>
    </form>
</x-guest-layout>