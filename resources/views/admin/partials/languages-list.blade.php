<section class="py-8">
    @if (session('language-delete-success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('language-delete-success') }}
        </div>
    @endif
    @foreach($languages as $language)
        <div class="flex items-center justify-between border-solid border-2 border-gray-300 dark:border-gray-700 p-2 my-2 dark:bg-gray-900">
            <div class="flex items-center gap-4">
                <span class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $language->name }}</span>
                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $language->code }}</span>
            </div>
            <div class="flex items-center gap-4">
                <a href="/" class="text-blue-500 hover:text-blue-700">{{ __('Edit') }}</a>
                <form method="post" action="{{ route('admin.delete-language', ['id' => $language->id]) }}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="text-red-500 hover:text-red-700">{{ __('Delete') }}</button>
                </form>
            </div>
        </div>
    @endforeach
</section>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('form[action*="delete-language"]');
        deleteButtons.forEach(function (button) {
            button.addEventListener('submit', function (event) {
                event.preventDefault();
                const isConfirmed = confirm('Are you sure you want to delete this language?');
                if (isConfirmed) {
                    event.target.submit();
                }
            });
        });
    });
</script>
