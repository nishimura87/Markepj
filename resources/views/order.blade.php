@extends('layouts.template')
@section('content')
<div class="main_title">
  <h1>ORDER</h1>
</div>
<div class="cart">
  <div class="cart_left">
    <div class="cart_fix">
      <div>
        <p>●お届け方法</p>
      </div>
      <div>
      <a class="cart_fix_btn" href="{{route('createAddressee')}}">変更する</a>
      </div>
    </div>
    <p class="cart_left_addressee cart_left_addressee_title">住所指定受け取り</p>
    @if(empty($addressee))
    <p class="cart_left_addressee">{{ $user['name'] }}</p>
    <p class="cart_left_addressee">{{ $user['kana'] }}</p>
    <p class="cart_left_addressee">{{ $user['postcode'] }}</p>
    <p class="cart_left_addressee">{{ $user['address'] }}</p>
    <p class="cart_left_addressee">{{ $user['building'] }}</p>
    <p class="cart_left_addressee">{{ $user['phone_number'] }}</p>
    @endif
    @if(!empty($addressee))
    <p class="cart_left_addressee">{{ $addressee['name'] }}</p>
    <p class="cart_left_addressee">{{ $addressee['kana'] }}</p>
    <p class="cart_left_addressee">{{ $addressee['postcode'] }}</p>
    <p class="cart_left_addressee">{{ $addressee['address'] }}</p>
    <p class="cart_left_addressee">{{ $addressee['building'] }}</p>
    <p class="cart_left_addressee">{{ $addressee['phone_number'] }}</p>
    @endif

    <div class="cart_fix">
      <div>
        <p>●購入商品</p>
      </div>
      <div>
        <a class="cart_fix_btn" href="{{route('cartList')}}">変更する</a>
      </div>
    </div>
    @foreach ($cartData as $key => $data)
    <ul class="cart_left_flex cart_left_border">
      <img src="{{ $data['img_path1'] }}" class="cart_img">
      <ul class="cart_item">
        <li class="cart_item_title">{{ $data['title'] }}</li>
        <li class="cart_item_info">品番：{{ $data['part_number'] }}</li>
        <li class="cart_item_info">カラー：{{ $data['color'] }}</pli>
        <li class="cart_item_info">サイズ：{{ $data['size'] }}</li>
        <li class="cart_item_info">数量:{{ $data['session_quantity'] }}</li>
      </ul>
    </ul>
    @endforeach

    <div class="cart_fix">
      <div>
        <p>●決済方法</p>
      </div>
      <div>
        <a class="cart_fix_btn" href="{{route('infoPayment')}}">変更する</a>
      </div>
    </div>
    <ul class="list-group">
      <li class="list-group-item"><span>カード番号：</span><span>{{$defaultCard["number"]}}</span></li>
      <li class="list-group-item"><span>カード有効期限（月/年):</span><span>{{$defaultCard["exp_month"]}}/{{$defaultCard["exp_year"]}}</span></li>
      <li class="list-group-item"><span>カード名義：</span><span>{{$defaultCard["name"]}}</span></li>
      <li class="list-group-item"><span>カードブランド：</span><span>{{$defaultCard["brand"]}}</span></li>
    </ul>
</div>
<div class="cart_right">
  <div class="cart_con">
    <div class="cart_con_between">
      <a class="order">注文内容</a>
      <a class="order">{{ $count }}件</a>
    </div>
    <div class="cart_con_price">
      <div class="cart_con_between2">
        <a class="price_txt">商品合計</a>
        <a>¥{{ number_format($totalData) }}</a>
      </div>
      <div class="cart_con_between2">
        <a>送料(一律)</a>
        <a>¥250</a>
      </div>
    </div>
    <div class="cart_con_between3">
      <a class="order">合計</a>
      <a class="order">¥{{ number_format($totalAmount) }}</a>
    </div>
  </div>
  <form method="POST" action="{{ route('charge') }}">
    @csrf
    <div class="item_order_cart">
      <input name="total" value="{{ $totalAmount }}" type="hidden">
      @if(!empty($addressee))
      <input name="postcode" value="{{ $addressee['postcode'] }}" type="hidden">
      <input name="address" value="{{ $addressee['address'] }}" type="hidden">
      <input name="building" value="{{ $addressee['building'] }}" type="hidden">
      @endif
      <button class="item_order_cart_btn" type="submit" name="action" value="submit">注文する</button>
    </div>
  </form>
</div>
@endsection