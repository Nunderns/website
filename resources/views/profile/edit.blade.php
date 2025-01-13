<!-- filepath: /c:/laragon/www/website/resources/views/profile/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ __('Edit Profile') }}</h1>

        <!-- Alterar Nome -->
        <section>
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Alterar Nome') }}
                </h2>
            </header>

            @include('profile.partials.update-profile-information-form')
        </section>

        <!-- Alterar Email -->
        <section class="mt-6">
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Alterar Email') }}
                </h2>
            </header>

            @include('profile.partials.update-email-form')
        </section>

        <!-- Alterar Senha -->
        <section class="mt-6">
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Alterar Senha') }}
                </h2>
            </header>

            @include('profile.partials.update-password-form')
        </section>
    </div>
@endsection