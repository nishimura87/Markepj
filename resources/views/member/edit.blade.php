@extends('layouts.template')
@section('content')
@if(session('status'))
<div class="flash_message">
  {{ session('warning') }}
</div>
@endif
<div class="main_title">
  <h1>MEMBER INFOMATION</h1>
</div>
<div class="register_update">
  <form method="POST" action="{{ route('updateUser') }}">
    @csrf  
    <div class="register_title">会員情報</div>

    <div class="form-item">
      <p class="form-item-label">お名前<span class ="red"> ※</span></p>
      <div class="form-item-con">
        <input type="text" class="input_text1" name=name value="{{ Auth::user()->name }}">
      </div>
    </div>
    @error('name')
    <div class="alert">{{ $message }}</div>
    @enderror

    <div class="form-item">
      <p class="form-item-label">フリガナ<span class ="red"> ※</span></p>
      <div class="form-item-con">
        <input type="text" class="input_text1" name=kana value="{{ Auth::user()->kana }}">
      </div>
    </div>
    @error('kana')
    <div class="alert">{{ $message }}</div>
    @enderror

    <div class="form-item">
      <p class="form-item-label">メールアドレス<span class ="red"> ※</span></p>
      <div class="form-item-con">
        <input type="email" class="input_text1" name=email value="{{ Auth::user()->email }}">
      </div>
    </div>
    @error('email')
    <div class="alert">{{ $message }}</div>
    @enderror

    <div class="form-item">
      <p class="form-item-label">郵便番号<span class ="red"> ※</span></p>
      <div class="form-item-con">
        <a class="postcode_mark">〒</a>
        <input type="text" class="input_text1" name=postcode value="{{ Auth::user()->postcode }}">
      </div>
    </div>
    @error('postcode')
    <div class="alert">{{ $message }}</div>
    @enderror

    <div class="form-item">
      <p class="form-item-label">住所<span class ="red"> ※</span></p>
      <div class="form-item-con">
        <input type="text" class="input_text1" name=address value="{{ Auth::user()->address }}">
      </div>
    </div>
    @error('address')
    <div class="alert">{{ $message }}</div>
    @enderror

    <div class="form-item">
      <p class="form-item-label">建物名</p>
      <div class="form-item-con">
        <input type="text" class="input_text1" name=building value="{{ Auth::user()->building }}">
      </div>
    </div>

    <div class="form-item">
      <p class="form-item-label">電話番号<span class ="red"> ※</span></p>
      <div class="form-item-con">
        <input type="text" class="input_text1" name=phone_number value="{{ Auth::user()->phone_number }}">
      </div>
    </div>
    @error('phone_number')
    <div class="alert">{{ $message }}</div>
    @enderror

    <div class="flex items-center justify-center mt-4">
      <button class="register_btn">
        {{ __('会員情報を更新') }}
      </button>
    </div>
  </form>
</div>
@endsection