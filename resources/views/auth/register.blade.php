@component('components.header')
@endcomponent
<x-guest-layout>
    <div class="main_title">
        <h1>会員登録</h1>
    </div>
    <x-auth-card>
        <form method="POST" action="{{ route('register') }}">
            <div class="register_title">会員登録</div>
            @csrf

            <!-- Name -->
            <div class="form-item">
                <p class="form-item-label">お名前<span class ="red"> ※</span></p>
                <div class="form-item-con">
                    <input type="text" class="input_text1" name=name value="{{ old('name') }}">
                </div>
            </div>
            @error('name')
            <div class="alert">{{ $message }}</div>
            @enderror

            <!-- Kana -->
            <div class="form-item">
                <p class="form-item-label">フリガナ<span class ="red"> ※</span></p>
                <div class="form-item-con">
                    <input type="text" class="input_text1" name=kana value="{{ old('kana') }}">
                </div>
            </div>
            @error('kana')
            <div class="alert">{{ $message }}</div>
            @enderror

            <!-- Email Address -->
            <div class="form-item">
                <p class="form-item-label">メールアドレス<span class ="red"> ※</span></p>
                <div class="form-item-con">
                    <input type="email" class="input_text1" name=email value="{{ old('email') }}">
                </div>
            </div>
            @error('email')
            <div class="alert">{{ $message }}</div>
            @enderror

            <!-- Password -->
            <div class="form-item">
                <p class="form-item-label">パスワード<span class ="red"> ※</span></p>
                <div class="form-item-con">
                    <input type="password" class="input_text1" name=password>
                </div>
            </div>
            @error('password')
            <div class="alert">{{ $message }}</div>
            @enderror

            <!-- Postcode -->
            <div class="form-item">
                <p class="form-item-label">郵便番号<span class ="red"> ※</span></p>
                <div class="form-item-con">
                    <a class="postcode_mark">〒</a>
                    <input type="text" class="input_text1" name=postcode value="{{ old('postcode') }}">
                </div>
            </div>
            @error('postcode')
            <div class="alert">{{ $message }}</div>
            @enderror

            <!-- address -->
            <div class="form-item">
                <p class="form-item-label">住所<span class ="red"> ※</span></p>
                <div class="form-item-con">
                    <input type="text" class="input_text1" name=address value="{{ old('address') }}">
                </div>
            </div>
            @error('address')
            <div class="alert">{{ $message }}</div>
            @enderror

            <!-- building -->
            <div class="form-item">
                <p class="form-item-label">建物名</p>
                <div class="form-item-con">
                    <input type="text" class="input_text1" name=building value="{{ old('building') }}">
                </div>
            </div>

            <!-- phone_number -->
            <div class="form-item">
                <p class="form-item-label">電話番号<span class ="red"> ※</span></p>
                <div class="form-item-con">
                    <input type="text" class="input_text1" name=phone_number value="{{ old('phone_number') }}">
                </div>
            </div>
            @error('phone_number')
            <div class="alert">{{ $message }}</div>
            @enderror

            <div class="flex items-center justify-center mt-4">
                <button class="register_btn">
                    {{ __('会員登録') }}
                </button>
            </div>
        </form>
        <div class="justify-end flex mt-4">
            <a class="login_txt" href="{{ route('login') }}">
                {{ __('アカウントをお持ちの方はこちら') }}
            </a>
        </div>
    </x-auth-card>
</x-guest-layout>
@component('components.footer')
@endcomponent
