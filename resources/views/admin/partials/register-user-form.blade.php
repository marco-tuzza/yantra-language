<div>
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="max-w-xl">
            @if (session('register-success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded flex items-center justify-between" 
                     data-register-success>
                    <div>
                        {{ session('register-success') }}
                    </div>
                    <button type="button" 
                            data-copy-password
                            class="ml-4 px-3 py-1 text-sm bg-green-500 text-white rounded-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-200 w-32 text-center whitespace-nowrap overflow-hidden text-ellipsis min-h-[2.5rem]">
                        {{ __('Copy') }}
                    </button>
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

@if (session('register-success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const copyButton = document.querySelector('[data-copy-password]');
        const successMessage = copyButton.closest('.bg-green-100');
        
        if (copyButton) {
            copyButton.addEventListener('click', function() {
                const message = "{{ session('register-success') }}";
                const password = message.match(/password: (.*)/i)[1];
                navigator.clipboard.writeText(password).then(() => {
                    const originalText = this.textContent;
                    this.textContent = "{{ __('Copied!') }}";
                    
                    setTimeout(() => {
                        this.textContent = originalText;
                        if (successMessage) {
                            successMessage.style.transition = 'opacity 1s';
                            successMessage.style.opacity = '0';
                            setTimeout(() => successMessage.remove(), 1000);
                        }
                    }, 2000);
                });
            });
        }
    });
</script>
@endif
