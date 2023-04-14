@extends('layouts.template')
@section('content')
<x-guest-layout>
    <div class="main_title">
        <h1>パスワードリセット</h1>
    </div>
    <x-auth-card>
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-item">
                <p class="form-item-label">メールアドレス<span class ="red"> ※</span></p>
                <div class="form-item-con">
                    <input type="email" class="input_text1" name=email value="{{ old('email') }}">
                </div>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
@endsection
