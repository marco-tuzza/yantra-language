<div>
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="max-w-xl">
            @if (session('register-success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('register-success') }}
                </div>
            @endif

            <section>
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Create a new user') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('NOTE: The password will be generated by the system for security reasons') }}
                    </p>
                </header>

                <form method="post" action="{{ route('admin.register') }}" class="mt-6 pb-6 space-y-6">
                    @csrf
                    @method('post')

                    <div>
                        <x-input-label for="username" :value="__('Username')" />
                        <x-text-input id="username" name="username" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->register->get('username')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="language" :value="__('Language')" />
                        <x-select-input :options="$languages->pluck('name', 'id')" id="language" name="language" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->register->get('language')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Register New User') }}</x-primary-button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
