<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Settings') }}
        </h2>
    </x-slot>
    @include('admin.partials.register-user-form')
    @include('admin.partials.language-section')
</x-app-layout>
