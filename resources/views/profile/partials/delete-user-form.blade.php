<section>
    <header>
        <h2 class="text-lg font-medium text-white">
            {{ __('Delete Account') }}
        </h2>
    </header>

    <form method="POST" action="{{ route('profile.destroy') }}" class="mt-6 space-y-6">
        @csrf
        @method('DELETE')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="password" :value="__('Password')" class="text-white" />
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-danger-button>{{ __('Delete Account') }}</x-danger-button>
        </div>
    </form>
</section>