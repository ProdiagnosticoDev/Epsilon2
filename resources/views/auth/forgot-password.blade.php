@extends('layouts.guest-adminlte')

@section('content')

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('¿Olvidaste tu contraseña? No hay problema. Simplemente indícanos tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña y podrás elegir una nueva..') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="text-danger mt-1" />
        </div>

        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary btn-block">
                {{ __('Enviar link para reestablecer Password ') }}
            </button>
        </div>
    </form>

@endsection
