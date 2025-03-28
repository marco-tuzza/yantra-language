<section class="py-8">
    @if (session('user-delete-success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('user-delete-success') }}
        </div>
    @elseif(session('user-update-success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('user-update-success') }}
        </div>
    @endif
    @foreach($users as $user)
        <div class="flex items-center justify-between border-solid border-2 border-gray-300 dark:border-gray-700 p-2 my-2 dark:bg-gray-900">
            <div class="flex items-center gap-4">
                <span class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $user->username }}</span>
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    @if($user->languages->isNotEmpty())
                        {{ $user->languages->pluck('code')->implode(' | ') }}
                    @endif
                </span>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.edit-user', ['id' => $user->id]) }}" class="text-blue-500 hover:text-blue-700">{{ __('Edit') }}</a>
                <form method="post" action="{{ route('admin.delete-user', ['id' => $user->id]) }}">
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
        const deleteButtons = document.querySelectorAll('form[action*="delete-user"]');
        deleteButtons.forEach(function (button) {
            button.addEventListener('submit', function (event) {
                event.preventDefault();
                const isConfirmed = confirm('Are you sure you want to delete this user?');
                if (isConfirmed) {
                    event.target.submit();
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const successMessage = document.querySelector('.bg-green-100:not([data-register-success])');
        if (successMessage) {
            setTimeout(function () {
                successMessage.style.transition = 'opacity 1s';
                successMessage.style.opacity = '0';
                setTimeout(() => successMessage.remove(), 1000);
            }, 3000);
        }
    });
</script>
