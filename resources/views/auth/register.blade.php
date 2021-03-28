<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="org_category" value="{{ __('Which sector do you work in?') }}" />
                <select id="org_category" name="org_category" class="bg-white rounded border border-gray-300 leading-normal resize-none w-full py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white">
                    <option value="">Please select an option ...</option>
                    <option value="Journalism">Journalism</option>
                    <option value="Academia">Academia</option>
                    <option value="Civil Society">Civil Society</option>
                    <option value="Company">Company</option>
                    <option value="Public Institution">Public Institution</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="mt-4">
                <x-jet-label for="org_name" value="{{ __('Please state the name of your organisation / institution') }}" />
                <x-jet-input id="org_name" class="block mt-1 w-full" type="text" name="org_name" :value="old('org_name')" />
            </div>

            <div class="mt-4">
                <input type="checkbox" name="contact_consent" id="contact_consent">
                <x-jet-label for="contact_consent" value="{{ __('I consent to being contacted by Transparency International') }}" class="inline" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
