@extends('layouts.template')
@section('content')
<div class="admin_user">管理者でログイン中</div>
<div class="main_title">
  <h1>NEWS</h1>
</div>
<div class="show_news">
  
    @if(isset($news['img_path']))
      <img src="{{ Storage::url($news['img_path']) }}" class="news_img">
    @endif

  <div class="news-title">
    {{ $news['title'] }}
  </div>

  <div class="news-body">
    {{ $news['body'] }}
  </div>
  
</div>
<div class="item_edit_btn">
  <form action="{{ route('fixNews', ['id'=>$news->id]) }}" method="GET" class="item_fix">
    <button type="submit" class="item_fix_btn">投稿を修正</button>
  </form>
  <form action="{{ route('deleteNews', ['id'=>$news->id]) }}" method="POST" class="item_delete">
    @csrf
    <button type="submit" class="item_delete_btn">投稿を削除</button>
  </form>
</div>
<div class="item_fix_txt">
  ※投稿を修正する場合、再度、画像を選択する必要があります
</div>
@endsection