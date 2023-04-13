@extends('layouts.template')
@section('content')
<div class="admin_user">管理者でログイン中</div>
<div class="page_img">
  <img src="/images/home.jpeg" width="100%">
</div>
<div class="main_title">
  <h1>NEWS</h1>
</div>
<div class="add_item_news">
  <a class="add_btn" href="{{ route('createNews') }}">ニュースを登録する</a>
</div>
<div class="item_list">
  <div class="item_list_one">
    <ul>
      @foreach ($news as $news)
      <li>
        <a href="{{route('editNews', ['id'=>$news->id])}}">
          @if(isset($news->img_path))
          <img src="{{ $news->img_path }}" class="home_img">
          @endif
          @if(empty($news->img_path))
          <img src="/images/no_image.jpg" class="home_img">
          @endif
          <p class="item_list_txt">{{ $news->created_at->format('Y/m/d') }}</p>
          <p class="item_list_txt">{{ $news->title }}</p>
        </a>
      </li>
      @endforeach
    </ul>
    <p class="more-btn">もっと見る</p>
  </div>
</div>
@endsection