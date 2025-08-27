<x-guest-layout>
    <div class="text-center mb-4">
        <a href="{{ route('masonry.index') }}" class="d-flex align-items-center justify-content-center mb-2 w-100">
            <img src="{{ asset('images/MotaZorrilla.png') }}" alt="MotaZorrilla Logo" style="max-height: 35px;">
        </a>
        <h2 class="text-light">Archivo Masónico</h2>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success mb-4">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-group mb-3">
            <label for="email">Correo Electrónico</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            @error('email')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group mb-3">
            <label for="password">Contraseña</label>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
            @error('password')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="form-check mb-3">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label for="remember_me" class="form-check-label">Recordarme</label>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            @if (Route::has('password.request'))
                <a class="text-sm" href="{{ route('password.request') }}">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif

            <button type="submit" class="btn btn-primary">
                Iniciar Sesión
            </button>
        </div>

        <div class="text-center mt-4">
            <a class="text-sm" href="{{ route('masonry.index') }}">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>
    </form>
</x-guest-layout>