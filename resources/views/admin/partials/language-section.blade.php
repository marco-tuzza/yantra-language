<div class="pb-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Languages') }}
                        </h2>
                    </header>
                    @include('admin.partials.language-list')
                    @include('admin.partials.add-language-form')
                </section>
            </div>
        </div>
    </div>
</div>
