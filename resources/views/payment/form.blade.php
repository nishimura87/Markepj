@extends('layouts.template')
@section('content')
<div class="main_title">
  <h1>MEMBER INFOMATION</h1>
</div>

<div class="card-body">
  <form action="{{route('storePayment')}}" class="card-form" id="form_payment" method="POST">
    @csrf
    <div class="form-group">
      <label for="name">カード番号</label>
      <div id="cardNumber"></div>
    </div>

    <div class="form-group">
      <label for="name">セキュリティコード</label>
      <div id="securityCode"></div>
    </div>

    <div class="form-group">
      <label for="name">有効期限</label>
      <div id="expiration"></div>
    </div>

    <div class="form-group">
      <label for="name">カード名義</label>
      <input type="text" name="cardName" id="cardName" class="form-control" value="" placeholder="カード名義を入力">
    </div>
    
    <div class="form-group">
      <input type="submit" id="create_token" value="カードを登録する"></input>
    </div>
  </form>
  <a href="{{route('infoPayment')}}">クレジットカード情報ページに戻る</a>
</div>
@endsection