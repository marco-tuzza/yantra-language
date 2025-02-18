<section class="py-8">
    @if (session('user-delete-success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('user-delete-success') }}
        </div>
    @endif
    @foreach($users as $user)
        <div class="flex items-center justify-between border-solid border-2 border-gray-300 dark:border-gray-700 p-2 my-2 dark:bg-gray-900">
            <div class="flex items-center gap-4">
                <span class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $user->username }}</span>
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
