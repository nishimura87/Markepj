@extends('layouts.template')
@section('content')
<div class="main_title">
  <h1>CART</h1>
</div>
<div class="cart">
  <div class="cart_left">
    @if(session()->has('message'))
      <div class="quantity_msg">{{session('message')}}</div>
    @endif
    @if (session('errors'))
    <div class="alert alert-danger" role="alert">
      {{ session('errors') }}
    </div>
    @endif
    @if(empty($cartData))
      <p>カートに商品がありません</p>
      <div class="cart_noitem">
        <a href="{{ route('home') }}" class="cart_noitem_btn">ホームに戻る</a>
      </div>
    @endif
    @if(isset($cartData))
    @foreach ($cartData as $key => $data)
    <div class="cart_left_flex">
      <img src="{{ \Storage::url($data['img_path1']) }}" class="cart_img">
      <div class="cart_item">
        <p class="cart_item_title">{{ $data['title'] }}</p>
        <p class="cart_item_info">品番：{{ $data['part_number'] }}</p>
        <p class="cart_item_info">カラー：{{ $data['color'] }}</p>
        <p class="cart_item_info">サイズ：{{ $data['size'] }}</p>
        <p class="cart_item_price">¥{{ number_format($data['price']) }}</p>
      </div>
      <div class="cart_subtotal">
        <div class="cart_quantity">
          <p>数量</p>
          <form method="POST" action="{{ route('updateCart') }}">
            @csrf
            <button type="submit" name="minus" value="minus" class="quantity_fix_btn">-</button>
            <a>{{ $data['session_quantity'] }}</a>
            <button type="submit" name="plus" value="plus" class="quantity_fix_btn">+</button>
            <input name="item_id" value="{{ $data['session_item_id'] }}" type="hidden">
            <input name="item_quantity" value="{{ $data['session_quantity'] }}" type="hidden">
          </form>
        </div>
        <p class="cart_subtotal_txt"><span class="cart_subtotal_info">小計:</span>¥{{ number_format($data['itemPrice']) }}</p>
      </div>
    </div>
    <form method="POST" action="{{ route('removeCart') }}">
      @csrf
      <div class="item_remove_cart">
        <button type="submit" name="action" value="submit">削除</button>
      </div>
      <input name="item_id" value="{{ $data['session_item_id'] }}" type="hidden">
      <input name="item_quantity" value="{{ $data['session_quantity'] }}" type="hidden">
    </form>
    @endforeach
  </div>
  <div class="cart_right">
    <div class="cart_con">
      <div class="cart_con_between">
        <a class="order">注文内容</a>
        <a class="order">{{ $count }}件</a>
      </div>
      <div class="cart_con_price">
        <div class="cart_con_between2">
          <a>商品合計</a>
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
    <form method="POST" action="{{ route('orderItem') }}">
      @csrf
      <div class="item_order_cart">
        <button class="item_order_cart_btn" type="submit" name="action" value="submit">購入手続き</button>
      </div>
      <input name="item_id" value="{{ $data['session_item_id'] }}" type="hidden">
      <input name="item_quantity" value="{{ $data['session_quantity'] }}" type="hidden">
    </form>
    <a href="{{ route('home') }}" class="cart_back_btn">買い物を続ける</a>
  </div>
  @endif
</div>
@endsection