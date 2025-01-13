@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-white">{{ __('Edit Profile') }}</h1>

        <!-- Alterar Nome -->
        <section class="mt-6">
            @include('profile.partials.update-profile-information-form')
        </section>

        <!-- Alterar Senha -->
        <section class="mt-6">
            @include('profile.partials.update-password-form')
        </section>

        <!-- Deletar Conta -->
        <section class="mt-6">
            @include('profile.partials.delete-user-form')
        </section>
    </div>
@endsection