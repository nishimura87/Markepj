@extends('layouts.template')
@section('content')
<div class="admin_user">管理者でログイン中</div>
<div class="main_title">
  <h1>ADD ITEM</h1>
</div>
<form method="POST" action="{{ route('storeItem') }}"
enctype="multipart/form-data">
  @csrf
  <div class="form-item-items">
    <div class="form-item-left">
      <div class="form-item-con">
        <img src="{{ $images[0] }}" width="70%">
      </div>
      <div class="form-item-img">
        @if(isset($images[1]))
        <img class="img-sub" src="{{ $images[1] }}" >
        @endif
        @if(isset($images[2]))
        <img class="img-sub" src="{{ $images[2] }}" >
        @endif
        @if(isset($images[3]))
        <img class="img-sub" src="{{ $images[3] }}" >
        @endif
        @if(isset($images[4]))
        <img class="img-sub" src="{{ $images[4] }}" >
        @endif
      </div>
      @foreach($images as $image)
      <input type="hidden" name="img_path[]" value="{{ $image }}">
      @endforeach
      <div class="size_table">●サイズ</div>
      <div class="form-item-size-table">
        <table>
          <tr>
            <th></th>
            <th>身幅</th>
            <th>肩幅</th>
            <th>着丈</th>
            <th>袖丈</th>
          </tr>
          <tr>
            <td>S</td>
            <td>67</td>
            <td>57</td>
            <td>79</td>
            <td>53.5</td>
          </tr>
          <tr>
            <td>M</td>
            <td>69</td>
            <td>59</td>
            <td>81</td>
            <td>55</td>
          </tr> 
          <tr>
            <td>L</td>
            <td>71</td>
            <td>60</td>
            <td>83</td>
            <td>56.5</td>
          </tr> 
        </table>
      </div>
    </div>
    
    <div class="form-item-right">
      <div class="item-title">
      {{ $inputs['title'] }}
      </div>
      <input name="title" value="{{ $inputs['title'] }}" type="hidden">

      <div class="form-item-con1">
      ¥{{ number_format($inputs['price']) }}
      <span class ="tax_txt">税込</span></p>
      </div>
      <input name="price" value="{{ $inputs['price'] }}" type="hidden">

      <div class="item-color">
        <a class="title_param">カラー</a>
        <a class="param_txt">{{ $inputs['color'] }}</a>
      </div>
      <input name="color" value="{{ $inputs['color'] }}" type="hidden">

      <div class="item-color">
        <a class="title_param">サイズ</a>
        <a class="param_txt">{{ $inputs['size'] }}</a>
      </div>
      <input name="size" value="{{ $inputs['size'] }}" type="hidden">

      <div class="quentity">
        <a class="title_param">数量</a>
        <select name="quantity" class="item-quentity">
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

      <div class="item_cart_btn">カートに入れる</div>

      <div class="item-part_number">
      商品番号 : {{ $inputs['part_number'] }}
      </div>
      <input name="part_number" value="{{ $inputs['part_number'] }}" type="hidden">

      <div class="item-info">
        <p class="title_param">[商品詳細]</p>
        <p class="param_txt">{{ $inputs['info'] }}<p>
      </div>
      <input name="info" value="{{ $inputs['info'] }}" type="hidden">

      <div class="item-material">
        <p class="title_param">[素材]</p>
        <p class="param_txt">{{ $inputs['material'] }}<p>
      </div>
      <input name="material" value="{{ $inputs['material'] }}" type="hidden">

      <div class="item-category">
        <a class="title_param">カテゴリー</a>
        <a class="param_txt">{{ $inputs['category'] }}</a>
      </div>
      <input name="category" value="{{ $inputs['category'] }}" type="hidden">
      <input name="quantity" value="{{ $inputs['quantity'] }}" type="hidden">
    </div>
  </div>
  <div class="item-create-btn">
    <button type="submit" class="fix_btn" name="action" value="back">入力内容修正</button>
    <button type="submit" class="send_btn" name="action" value="submit">登録</button>
  </div>
  <div class="item_fix_txt item_create_txt">※商品を修正する場合、再度、画像を選択する必要があります
  </div>
</div>
</form>

@endsection