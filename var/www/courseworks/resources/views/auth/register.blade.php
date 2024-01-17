@php
    use App\Models\User;
@endphp
<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" id="register-account-form">
        <div class="welcome-text">
            <h3>{{ __('Создать аккаунт') }}</h3>
        </div>
        @csrf
        <div class="account-type">
            <div>
                <input type="radio" name="role" id="freelancer-radio" class="account-type-radio" value="{{ User::ROLE_EXECUTOR }}" checked/>
                <label for="freelancer-radio" class="ripple-effect-dark"><i class="icon-material-outline-account-circle"></i> Исполнитель</label>
            </div>

            <div>
                <input type="radio" name="role" id="employer-radio" class="account-type-radio" value="{{ User::ROLE_CUSTOMER }}"/>
                <label for="employer-radio" class="ripple-effect-dark"><i class="icon-material-outline-business-center"></i> Заказчик</label>
            </div>
        </div>
        <!-- Name -->
        <div class="input-with-icon-left">
            <i class="icon-material-baseline-mail-outline"></i>
            <x-text-input id="name" class="input-text with-border"  type="text" name="name" :value="old('name')" placeholder="Nickname" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="input-with-icon-left">
            <i class="icon-material-baseline-mail-outline"></i>
            <x-text-input id="email" class="input-text with-border" type="email" name="email" :value="old('email')" placeholder="Email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="input-with-icon-left">
            <i class="icon-material-outline-lock"></i>

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            placeholder="Пароль"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="input-with-icon-left">
            <i class="icon-material-outline-lock"></i>

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            placeholder="Подтверждение пароля"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('У вас есть аккаунт?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Регистрация') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
