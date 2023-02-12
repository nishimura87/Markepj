@extends('layouts.template')
@section('content')
<div class="main_title">
  <h1>MEMBER INFOMATION</h1>
</div>
<div class="member">

  <div class="menber_info">
    <div class="info_left">
      <h2 class="info_title">■会員詳細情報</h2>
      <div class="member_detail">
        <p>名前</p>
        <p>{{ Auth::user()->name }}</p>
      </div>
      <div class="member_detail">
        <p>フリガナ</p>
        <p>{{ Auth::user()->kana }}</p>
      </div>
      <div class="member_detail">
        <p>メールアドレス</p>
        <p>{{ Auth::user()->email }}</p>
      </div>
      <div class="member_detail">
        <p>郵便番号</p>
        <p>〒 {{ Auth::user()->postcode }}</p>
      </div>
      <div class="member_detail">
        <p>住所</p>
        <p>{{ Auth::user()->address }}</p>
      </div>
      @if(!empty(Auth::user()->building))
      <div class="member_detail">
        <p>建物名</p>
        <p>{{ Auth::user()->building }}</p>
      </div>
      @endif
      <div class="member_detail">
        <p>電話番号</p>
        <p>{{ Auth::user()->phone_number }}</p>
      </div>
    </div>
    <div class="info_right">
      <form method="GET" action="{{ route('editUser') }}">
      @csrf
        <button class="member_btn">
          会員情報の変更
        </button>
      </form>
    </div>
  </div>

  <div class="menber_info">
    <div class="info_left">
      <div class="member_password">
        <h2 class="info_title">■パスワード</h2>
      </div>
    </div>
    <div class="info_right">
      <form method="GET" action="{{ route('editPassword') }}">
      @csrf
        <button class="member_btn">
          パスワードの変更
        </button>
      </form>
    </div>
  </div>

  <div class="menber_info">
    <div class="info_left">
      <h2 class="info_title">■クレジットカード情報</h2>
    </div>
    <div class="info_right">
      <form method="GET" action="{{ route('infoPayment') }}">
      @csrf
        <button class="member_btn">
          クレジットカードの登録
        </button>
      </form>
    </div>
  </div>
</div>
@endsection