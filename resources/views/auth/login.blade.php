@component('components.header')
@endcomponent
<x-guest-layout>
    <div class="main_title">
        <h1>ログイン・会員登録</h1>
    </div>
    <x-auth-card>
        <div class="flex w-full">
            <div class="login_title">ログイン</div>
            <div class="login_register_title">新規会員</div>
        </div>
        <div class="login_register flex sm\:justify-between">
            <div class="login w-full"> 
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />


                @error('email')
                    <div class="alert">{{ $message }}</div>
                @enderror

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="px-4">

                        <!-- Email Address -->
                        <div>
                            <x-label for="email" :value="__('メールアドレス')" />

                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="例）marke@marke.com" required autofocus />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-label for="password" :value="__('パスワード')" />

                            <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                placeholder="例）marke123"
                                required autocomplete="current-password" />
                        </div>

                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                <span class="ml-2 text-sm text-gray-600">{{ __('ログイン状態を保存する') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                            <a class="underline text-sm link" href="{{ route('password.request') }}">
                                {{ __('パスワードを忘れた方はこちら') }}
                            </a>
                            @endif
                        </div>
                        <button class="login_btn">
                            {{ __('ログイン') }}
                        </button>
                    </div>
                </form>
            </div>

            <div class="register w-full"> 
                <form method="GET" action="{{ route('register') }}">
                    
                        <div class="px-4">
                            <div class="register_txt">
                                <p>オンラインストアをご使用いただくには、会員登録が必要です。</p>
                                <p>下記より新規会員登録をお願いします。</p>
                            </div>
                            <button class="register_btn">
                                {{ __('会員登録') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-auth-card>
</x-guest-layout>
@component('components.footer')
@endcomponent