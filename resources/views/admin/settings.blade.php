<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Settings') }}
        </h2>
    </x-slot>
    @include('admin.partials.user-section')
    @include('admin.partials.languages-section')
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const section = urlParams.get('section');
        
        if (section === 'languages') {
            const languagesSection = document.querySelector('.languages-section');
            if (languagesSection) {
                languagesSection.scrollIntoView({ behavior: 'smooth' });
            }
        }
    });
</script>
