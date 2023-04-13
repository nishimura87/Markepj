@extends('layouts.template')
@section('content')
<div class="main_title">
  <h1>ORDER HISTORY</h1>
</div>
<div class="order_history">
  @foreach($orders as $order)
  <div class="order_history_con">
    <img class="order_history_img_path" src="{{ $order->item->img_path1 }}">
    <div class="order_history_info">
      <div class="order_history_info_txt">
        <p class="order_history_info_txt_title">{{ $order->item->title }}</p>
      </div>
      <div class="order_history_info_txt">
        <a class="order_history_info_txt_item">{{ $order->item->color }}</a>
        <a class="order_history_info_txt_item">/ {{ $order->item->size }}</a>
      </div>
      <div class="order_history_info_txt">
        <a class="order_history_info_price">¥{{ number_format($order->price) }} <span class="order_history_info_quantity">税込</span></a>
        <p class="order_history_info_quantity">数量:{{ $order->quantity }}</p>
      </div>
    </div>
    <div class="order_history_info">
      <p class="order_history_info_date"><span class="order_history_info_date_title">注文日</span>:{{ $order->created_at->format('Y/m/d') }}</p>
      <p class="order_history_info_date"><span class="order_history_info_date_title">注文番号</span>:{{ $order->order_number }}</p>
    </div>
  </div>
  @endforeach
</div>

@endsection