@extends('layouts.template')
@section('content')
<div class="main_title">
  <h1>MEMBER INFOMATION</h1>
</div>
<div class="password_edit">
  <div class="password_title">パスワード変更</div>

  <form method="POST" action="{{ route('updatePassword') }}">
  @csrf
    <div class="form-item">
      <p class="form-item-label">以前のパスワード<span class ="red"> ※</span></p>
      <div class="form-item-con">
        <input type="password" class="input_text1" name=current_password>
      </div>
      @if(session('warning'))
      <div class="flash_mesaage">
        {{ session('warning') }}
      </div>
      @endif
    </div>

    <div class="form-item">
      <p class="form-item-label">新しいパスワード<span class ="red"> ※</span></p>
      <div class="form-item-con">
        <input type="password" class="input_text1" name=new_password>
      </div>
      @error('new_password')
        <div class="alert">{{ $message }}</div>
      @enderror
    </div>
    

    <div class="update_password">
      <button class="update_password_btn">
        パスワードの変更
      </button>
    </div>
  </form>
</div>
@endsection