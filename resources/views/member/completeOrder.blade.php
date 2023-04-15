@extends('layouts.template')
@section('content')
<div class="main_title">
  <h1>ORDER</h1>
</div>
<div class="conmpleteCharge">
  <p class="conmpleteCharge_title">●ご注文完了</p>
  <div class="conmpleteCharge_con">
    <p class="conmpleteCharge_name">{{ $user->name }}　様</p>
  </div>
  <div class="conmpleteCharge_con">
    <p class="conmpleteCharge_txt">誠にありがとうございます。ご注文が完了しました。</p>
  </div>
  <div class="conmpleteCharge_con">
    <p class="conmpleteCharge_txt">ご登録のメールアドレスへ「ご注文完了メール」をお送りしますので、ご確認ください。<br>しばらく経ってもご注文完了メールが届かない場合は「CONTACT」よりお問い合わせください。</p>
  </div>
  <div class="conmpleteCharge_con">
    <p>ご注文番号：{{ $code }}</p>
    <p>発注日時：{{ $date }}</p>
    <p>ご登録メールアドレス：{{ $user->email }}</p>
  </div>
  <div class="conmpleteCharge_btn">
    <a href="{{ route('home') }}" class="cart_noitem_btn">ホームに戻る</a>
  </div>


</div>

@endsection