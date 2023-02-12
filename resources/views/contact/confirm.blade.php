@extends('layouts.template')
@section('content')
<div class="page_img">
  <img src="/images/home.jpeg" width="100%">
</div>

<div class="main_title">
  <h1>CONTACT</h1>
</div>

<form method="POST" action="{{ route('send') }}">
@csrf
<div class="contact_confirm">
  <div class="form-item">
    <p class="form-item-label">お名前</p>
    <div class="form-item-con">
      {{ $inputs['name'] }}
    </div>
    <input name="name" value="{{ $inputs['name'] }}" type="hidden">

  </div>

  <div class="form-item">
    <p class="form-item-label">メールアドレス</p>
    <div class="form-item-con">
      <div class="form-item-con">
      {{ $inputs['email'] }}
      </div>
      <input name="email" value="{{ $inputs['email'] }}" type="hidden">
    </div>
  </div>

  <div class="form-item">
    <p class="form-item-label">電話番号</p>
    <div class="form-item-con">
      {{ $inputs['phone_number'] }}
    </div>
    <input name="phone_number" value="{{ $inputs['phone_number'] }}" type="hidden">
  </div>

  <div class="form-item">
    <p class="form-item-label">件名</p>
    <div class="form-item-con">
      {{ $inputs['title'] }}
    </div>
    <input name="title" value="{{ $inputs['title'] }}" type="hidden">
  </div>

  <div class="form-item">
    <p class="form-item-label">お問い合わせ内容</p>
    <div class="form-item-con">
      {{ $inputs['body'] }}
    </div>
    <input name="body" value="{{ $inputs['body'] }}" type="hidden">
  </div>

  <div class="confirm_con">
    <button type="submit" class="fix_btn" name="action" value="back">入力内容修正</button>
    <button type="submit" class="send_btn" name="action" value="submit">送信</button>
  </div>
</div>
</form>

@endsection