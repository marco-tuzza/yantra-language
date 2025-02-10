<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Users') }}
                        </h2>
                    </header>
                    @include('admin.partials.users-list')
                    @include('admin.partials.register-user-form')
                </section>
            </div>
        </div>
    </div>
</div>
