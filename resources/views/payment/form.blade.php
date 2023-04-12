@extends('layouts.template')
@section('content')
<div class="main_title">
  <h1>MEMBER INFOMATION</h1>
</div>

<div class="card">
  <form action="{{route('storePayment')}}" class="card-form" id="form_payment" method="POST">
    @csrf
    <div class="form-group">
      <label for="cardNumber">カード番号</label>
      <div id="cardNumber" class="form-card"></div>
    </div>

    <div class="form-group">
      <label for="securityCode">セキュリティコード</label>
      <div id="securityCode" class="form-card"></div>
    </div>

    <div class="form-group">
      <label for="expiration">有効期限</label>
      <div id="expiration" class="form-card"></div>
      <input type="hidden" name="cardExpMonth" data-stripe="exp_month">
      <input type="hidden" name="cardExpYear" data-stripe="exp_year">
    </div>

    <div class="form-group">
      <label for="text">カード名義</label>
      <p><input type="text" name="cardName" id="cardName" class="form-card" value="" placeholder="カード名義を入力"></p>
    </div>
    
      <input class="btn-primary" type="submit" id="create_token" value="カードを登録する"></input>
  </form>
  <a class="payment_back_btn" href="{{route('infoPayment')}}">カード情報に戻る</a>
</div>
@endsection