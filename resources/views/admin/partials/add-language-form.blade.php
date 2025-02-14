<div class="pb-12">
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="max-w-xl">
            @if (session('language-add-success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('language-add-success') }}
                </div>
            @endif

            <section>
                <header>
                    <h3 class="text-md font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Add a new language') }}
                    </h3>
                </header>

                <form method="post" action="{{ route('admin.add-language') }}" class="mt-6 pb-6 space-y-6">
                    @csrf
                    @method('post')

                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->language->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="code" :value="__('Country Code')" />
                        <x-text-input id="code" name="code" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->language->get('code')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Add new language') }}</x-primary-button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
