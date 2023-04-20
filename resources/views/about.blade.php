@extends('layouts.template')
@section('content')
<div class="page_img">
  <img src="/images/home.jpeg" width="100%">
</div>
<div class="main_title">
  <h1>ABOUT</h1>
</div>
<div class="about">
  <div class="about_con">
    <h2 class="shop_name">MARKE<h2>
    <div class="about_datail">
      <p>PHONE : 000-0000-0000</p>
      <p>Open : 11:00~19:00</p>
      <p>Close : 水曜日</p>
      <p>Add : 東京都港区芝公園4-2-8
    </div>
    <div class="about_image">
      <div class="about_image_con">
        <a href="https://twitter.com/Marke2023"><img class="about_image_sns" src="/images/twitter_color.png" width="40px"></a>
        <a class=about_image_txt>twitter</a>
      </div>
      <div class="about_image_con">
        <a href="https://z-p15.www.instagram.com/marke2023_test/"><img class="about_image_sns" src="/images/instagram_color.png" width="40px"></a>
        <a class=about_image_txt>instagram</a>
      </div>
    </div>
    <div class="about_qrcode_con">
        <div class="about_qrcode_home">{!! QrCode::size(40)->generate(route('home'))!!}</div>
        <a class=about_image_txt>ホームページ</a>
      </div>
  </div>
  <div class="about_map">
    <div id="map" class="about_map_size"></div>
  </div>  
</div>
<script src="{{ asset('/js/result.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyAVgFVHHjzsd0aG-NWUkWGm29ip8BTrDzo&callback=initMap" async defer></script>

@endsection