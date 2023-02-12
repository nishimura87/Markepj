@component('components.header')
@endcomponent
<x-guest-layout>
    <div class="main_title">
        <h1>パスワードリセット</h1>
    </div>
    <x-auth-card>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="form-item">
                <p class="form-item-label">メールアドレス<span class ="red"> ※</span></p>
                <div class="form-item-con">
                    <input type="email" class="input_text1" name=email value="{{ old('email') }}">
                </div>
            </div>
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <!-- Password -->
            <div class="form-item">
                <p class="form-item-label">パスワード<span class ="red"> ※</span></p>
                <div class="form-item-con">
                    <input type="password" class="input_text1" name=password>
                </div>
            </div>
            @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('パスワードリセット') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
@component('components.footer')
@endcomponent
