@extends('layouts.template')
@section('content')
<div class="admin_user">管理者でログイン中</div>
<div class="page_img">
  <img src="/images/home.jpeg" width="100%">
</div>
<div class="main_title2">
  <div class="main_title2_left">
    <h1>ONLINE SHOP</h1>
  </div>
  <div class="main_title2_right">
  <div class="category_list">
    <ul class="nav">
      <li class="has-sub category_list_item">
        <a class="sub-item">CATEGORY</a>
        <ul class="sub category_list_name">
          @foreach ($categories as $category)
          <li>
            <a class="sub-item" href="{{route('categoryItem', ['name'=>$category->name])}}">{{ $category->name }}</a>
          </li>
          @endforeach
        </ul>
      </li>
    </ul>
  </div>
  <div>
    <form action="{{ route('home') }}" method="GET">
      <input class="serch_box" type="search" name="word" value="{{ isset($word) ? $word : '' }}" placeholder="キーワードを入力" size="16">
      <input class="search_btn" type="submit" value="検索">
    </form>
  </div>
</div>
</div>

<div class="add_item_news">
  <a class="add_btn" href="{{ route('createItem') }}">商品を登録する</a>
</div>
<div class="item_list">
  <div class="item_list_one">
  <ul>
    @foreach ($items as $item)
    <li>
      <a class="item_list_img" href="{{route('editItem', ['id'=>$item->id])}}">
        <img src="https://marke-test.s3.amazonaws.com/{{ $item->img_path1 }}" class="home_img">
        <p class="item_list_txt">{{ $item->title }}</p>
        <p class="item_list_txt">¥ {{ number_format($item->price) }}</p>
      </a>
    </li>
    @endforeach
  </ul>
  <p class="more-btn">もっと見る</p>
  </div>
</div>
@endsection