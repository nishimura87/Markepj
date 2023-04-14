@extends('layouts.template')
@section('content')
<div class="admin_user">管理者でログイン中</div>
<div class="page_img">
  <img src="/images/home.jpeg" width="100%">
</div>
<div class="main_title">
  <h1>ITEM</h1>
</div>
  <div class="form-item-items">
    <div class="form-item-left">
      <section>
      <div class="main_img">
        <img src="https://marke-test.s3.amazonaws.com/{{ $item['img_path1'] }}" width="70%">
      </div>
      <div class="sub_img">
        <dl>
          @if(isset($item['img_path1']))
          <dt>
            <img src="https://marke-test.s3.amazonaws.com/{{ $item['img_path1'] }}">
          </dt><dd></dd>
          @endif
          <dt>
          @if(isset($item['img_path2']))
            <img src="https://marke-test.s3.amazonaws.com/{{ $item['img_path2'] }}">
          </dt><dd></dd>
          @endif
          @if(isset($item['img_path3']))
          <dt>
            <img src="https://marke-test.s3.amazonaws.com/{{ $item['img_path3'] }}">
          </dt><dd></dd>
          @endif
          @if(isset($item['img_path4']))
          <dt>
            <img src="https://marke-test.s3.amazonaws.com/{{ $item['img_path4'] }}">
          </dt><dd></dd>
          @endif
          @if(isset($item['img_path5']))
          <dt>
            <img src="https://marke-test.s3.amazonaws.com/{{ $item['img_path5'] }}">
          </dt><dd></dd>
          @endif
        </dl>
      </div>
      </section>
    </div>
    
    <div class="form-item-right">
      <div class="item-title">
        {{ $item['title'] }}
      </div>

      <div class="form-item-con1">
        ¥{{ number_format($item['price']) }}
        <span class ="tax_txt">税込</span></p>
      </div>

      <div class="item-color">
        <a class="title_param">カラー</a>
        <a class="param_txt">{{ $item['color'] }}</a>
      </div>

      <div class="item-color">
        <a class="title_param">サイズ</a>
        <a class="param_txt">{{ $item['size'] }}</a>
      </div>

      <div class="quentity">
        <a class="title_param">数量</a>
        <select name="quantity" class="item-quentity" id="quentity">
          <option value="1" selected>1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
        </select>
      </div>

      <div class="item_cart_btn" name="action" value="submit">カートに入れる</div>

      <div class="item-part_number">
        商品番号 : {{ $item['part_number'] }}
      </div>

      <div class="item-info">
        <p class="title_param">[商品詳細]</p>
        <p class="param_txt">{{ $item['info'] }}<p>
      </div>

      <div class="item-material">
        <p class="title_param">[素材]</p>
        <p class="param_txt">{{ $item['material'] }}<p>
      </div>

      <div class="item-category">
        <p class="title_param">[カテゴリー]</p>
        <a class="param_txt" href="{{route('categoryItem', ['name'=>$category->name])}}">{{ $category['name'] }}</a>
      </div>
    </div>
  </div>
  <div class="item_edit_btn">
    <form action="{{ route('fixItem', ['id'=>$item->id]) }}" method="GET" class="item_fix">
      <button type="submit" class="item_fix_btn">商品を修正</button>
    </form>
    <form action="{{ route('deleteItem', ['id'=>$item->id]) }}" method="POST" class="item_delete">
      @csrf
      <button type="submit" class="item_delete_btn">商品を削除</button>
    </form>
  </div>
  <div class="item_fix_txt">
    ※商品を修正する場合、再度、画像を選択する必要があります
  </div>
@endsection