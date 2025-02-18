<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit user: ') }} {{ $user->username }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('User Info') }}
                            </h2>
                        </header>
                        <section class="py-8">
                            <form method="post" action="{{ route('admin.update-user', ['id' => $user->id]) }}">
                                @csrf
                                @method('put')
                                <div class="mb-4">
                                    <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Username') }}</label>
                                    <input type="text" name="username" id="username" value="{{ $user->username }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-gray-100">
                                </div>
                                <div class="flex flex-wrap w-2/3">
                                    @foreach($languages as $language)
                                        <div class="w-1/3">
                                            <input type="checkbox" name="languages[]" value="{{ $language->id }}" class="rounded border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-gray-100" {{ in_array($language->id, $userLanguages) ? 'checked' : '' }}>
                                            <label for="languages" class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ $language->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-4 rounded">{{ __('Update') }}</button>
                            </form>
                        </section>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
