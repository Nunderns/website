<!-- filepath: /c:/laragon/www/website/resources/views/pages/donations.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-white mt-6">Doações</h1>
    <p class="text-white mt-4">
        Agradecemos o seu interesse em apoiar nosso site. Suas doações nos ajudam a manter o site funcionando e a melhorar nossos serviços.
    </p>
    <div class="mt-6">
        <h2 class="text-2xl font-bold text-white">Como doar</h2>
        <p class="text-white mt-2">
            Você pode fazer uma doação através dos seguintes métodos:
        </p>
        <ul class="list-disc list-inside text-white mt-2">
            <li>PayPal: <a href="https://www.paypal.com/donate/?business=9X2PSUKCFNW3J&no_recurring=0&currency_code=USD" class="text-blue-400">Clique aqui para doar via PayPal</a></li>
            <li>Buy Me a Coffee: <a href="https://www.buymeacoffee.com/yourusername" class="text-blue-400">Clique aqui para doar via Buy Me a Coffee</a></li>
            <li>Patreon: <a href="https://www.patreon.com/yourusername" class="text-blue-400">Clique aqui para doar via Patreon</a></li>
        </ul>
    </div>
</div>
@endsection