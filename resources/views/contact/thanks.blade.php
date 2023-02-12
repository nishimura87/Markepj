@extends('layouts.template')
@section('content')
<div class="main_title">
  <h1>CONTACT</h1>
</div>
<div class="thanks">
  <div class="mail_image">
    <img src="/images/mail.png" width="20%">
  </div>
  <div class="thanks_txt">
    <p class="thanks_txt1">お問い合わせが完了しました。</p>
    <p class="thanks_txt2">近日中に改めてご回答いたします。</p>
  </div>
  <form method="GET" action="{{ route('home') }}">
    <div class="thanks_con">
      <button type="submit" class="thanks_btn">ホームへ戻る</button>
    </div>
  </form>
</div>
@endsection