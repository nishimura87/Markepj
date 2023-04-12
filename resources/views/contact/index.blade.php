@extends('layouts.template')
@section('content')
<div class="page_img">
  <img src="/images/home.jpeg" width="100%">
</div>

<div class="main_title">
  <h1>CONTACT</h1>
</div>

<form method="POST" action="{{ route('confirm') }}">
@csrf
<div class="form-item">
  <p class="form-item-label">お名前<span class ="red"> ※</span></p>
  <div class="form-item-con">
    <input type="text" class="input_text1" name=name value="{{ old('name') }}" placeholder="例）山口 太郎">
  </div>
  @error('name')
  <div class="alert">{{ $message }}</div>
  @enderror

  <p class="form-item-label">メールアドレス<span class ="red"> ※</span></p>
  <div class="form-item-con">
    <input type="email" class="input_text1" name=email value="{{ old('email') }}" placeholder="例）marke@marke.jp">
  </div>
  @error('email')
  <div class="alert">{{ $message }}</div>
  @enderror

  <p class="form-item-label">電話番号</p>
  <div class="form-item-con">
    <input type="tel" class="input_text1" name=phone_number value="{{ old('phone_number') }}" placeholder="例）08012341234">
  </div>
  @error('phone_number')
  <div class="alert">{{ $message }}</div>
  @enderror

  <p class="form-item-label">件名<span class ="red"> ※</span></p>
  <div class="form-item-con">
    <input type="text" class="input_text1" name=title value="{{ old('title') }}" placeholder="例）商品の再入荷について">
  </div>
  @error('title')
  <div class="alert">{{ $message }}</div>
  @enderror

  <p class="form-item-label">お問い合わせ内容<span class ="red"> ※</span></p>
  <div class="form-item-con">
    <textarea class="input_text1" rows="5" cols="33" name=body placeholder="例）商品コード****-**-**を購入したいのですが、再入荷の予定はありますか。">{{ old('body') }}</textarea>
  </div>
  @error('body')
  <div class="alert">{{ $message }}</div>
  @enderror
</div>

<div class="form-item-con">
  <button type="submit" class="confirm_btn">入力内容確認</button>
</div>
</form>

@endsection