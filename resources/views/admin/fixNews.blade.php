@extends('layouts.template')
@section('content')
<div class="admin_user">管理者でログイン中</div>
<div class="main_title">
  <h1>ADD NEWS</h1>
</div>
<form method="POST" action="{{ route('updateNews', ['id'=>$news->id]) }}"
enctype="multipart/form-data">
  @csrf
  <div class="form_news">

    <p class="form-item-label">画像</p>
    @if(isset($news['img_path']))
      <img class="news_img" src="{{ $news['img_path'] }}" >
    @endif

    <div class="form-item-con1">
      <input type="file" id="img_path" name="img_path">
    </div>
    @error('img_path')
    <div class="alert">{{ $message }}</div>
    @enderror
    
    <p class="form-item-label">タイトル<span class ="red"> ※</span></p>
    <div class="form-item-con">
      <input type="text" class="input_text1" name=title value="{{ $news['title'] }}" placeholder="例）2023/3/6 新商品情報">
    </div>
    @error('title')
      <div class="alert">{{ $message }}</div>
    @enderror

    <p class="form-item-label">本文<span class ="red"> ※</span></p>
    <div class="form-item-con">
      <textarea class="input_text1" rows="8" cols="33" name=body placeholder="例）新商品「Relax Fit SHIRT」が入荷いたしました！
      詳細は商品をご確認ください。">{{ $news['body'] }}</textarea>
    </div>
    @error('body')
    <div class="alert">{{ $message }}</div>
    @enderror
    
    <div class="item-confirm-btn">
      <button type="submit" class="confirm_btn">内容更新</button>
    </div>
  </div>
</form>
@endsection