<body class="login-page bg-body-secondary app-loaded">
  <div class="skip-links">
    <a href="#main" class="skip-link">Skip to main content</a>
    <a href="#navigation" class="skip-link">Skip to navigation</a>
  </div>

  <div class="login-box">
    <div class="login-logo">
      <a href="../index2.html"><b>Prodiagnóstico</b></a>
    </div>

    <div class="card shadow">
      <div class="card-body login-card-body">
        <!--p class="login-box-msg fs-5 text-muted">Sign in to start your session</p-->

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
          @csrf

          <!-- Email -->
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email"
                   class="form-control"
                   id="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autofocus
                   autocomplete="username">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
          </div>

          <!-- Password -->
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password"
                   class="form-control"
                   id="password"
                   name="password"
                   required
                   autocomplete="current-password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
          </div>

          <!-- Remember Me (optional) -->
          <!--
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
            <label class="form-check-label" for="remember_me">Remember me</label>
          </div>
          -->

          <!-- Actions -->
          <div class="d-flex justify-content-between align-items-center mt-4">
            @if (Route::has('password.request'))
              <a class="text-sm text-decoration-none" href="{{ route('password.request') }}">
                {{ __('Olvidaste tu contraseña ?') }}
              </a>
            @endif

            <x-primary-button class="btn btn-primary">
              {{ __('Log in') }}
            </x-primary-button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div id="live-region" class="live-region" aria-live="polite" aria-atomic="true" role="status"></div>
</body>
