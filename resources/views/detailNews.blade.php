@extends('layouts.template')
@section('content')
<div class="main_title">
  <h1>NEWS</h1>
</div>
<div class="show_news">
  @if(isset($news['img_path']))
    <img src="https://marke-test.s3.amazonaws.com/{{ $news->img_path }}" class="news_img">
  @endif
    
  <div class="news-title">
    {{ $news['title'] }}
  </div>

  <div class="news-body">
    {{ $news['body'] }}
  </div>
  
  <div class="back_news">
    <a href="{{ route('news') }}" class="back_news_btn">ニュースに戻る</a>
  </div>

</div>
@endsection