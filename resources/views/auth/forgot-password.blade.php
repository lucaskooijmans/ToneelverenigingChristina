<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Je wachtwoord vergeten? Geen probleem. Laat ons uw e-mailadres weten en wij sturen u per e-mail een link voor het opnieuw instellen van uw wachtwoord waarmee u een nieuw wachtwoord kunt kiezen.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Wachtwoord Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
