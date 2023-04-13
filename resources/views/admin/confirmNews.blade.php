@extends('layouts.template')
@section('content')
<div class="admin_user">管理者でログイン中</div>
<div class="main_title">
  <h1>ADD NEWS</h1>
</div>
<form method="POST" action="{{ route('storeNews') }}"
enctype="multipart/form-data">
  @csrf
  <div class="show_news">

    <div class="form-item-con">
      @if(isset($image))
        <img src="{{ $image }}" class="news_img">
        <input type="hidden" name="img_path" value="{{ $image }}">
      @endif
      @if(empty($image))
        <img src="/images/no_image.jpg" class="news_img">
      @endif
      </div>
    
    <div class="news-title">
      {{ $inputs['title'] }}
    </div>
    <input name="title" value="{{ $inputs['title'] }}" type="hidden">

    <div class="news-body">
      {{ $inputs['body'] }}
    </div>
    <input name="body" value="{{ $inputs['body'] }}" type="hidden">
    
    <div class="item-create-btn">
      <button type="submit" class="fix_btn" name="action" value="back">入力内容修正</button>
      <button type="submit" class="send_btn" name="action" value="submit">登録</button>
    </div>
  </div>
</form>
@endsection