@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dashboard</h1>
        <!-- Inclua o layout parcial aqui -->
        @include('profile.partials.update-profile-information-form')
    </div>
@endsection
