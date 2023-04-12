@extends('layouts.template')
@section('content')
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
        <img src="{{ Storage::url($item['img_path1']) }}" width="70%">
      </div>
      <div class="sub_img">
        <dl>
          @if(isset($item['img_path1']))
          <dt>
            <img src="{{ Storage::url($item['img_path1']) }}">
          </dt><dd></dd>
          @endif
          <dt>
          @if(isset($item['img_path2']))
            <img src="{{ Storage::url($item['img_path2']) }}">
          </dt><dd></dd>
          @endif
          @if(isset($item['img_path3']))
          <dt>
            <img src="{{ Storage::url($item['img_path3']) }}">
          </dt><dd></dd>
          @endif
          @if(isset($item['img_path4']))
          <dt>
            <img src="{{ Storage::url($item['img_path4']) }}">
          </dt><dd></dd>
          @endif
          @if(isset($item['img_path5']))
          <dt>
            <img src="{{ Storage::url($item['img_path5']) }}">
          </dt><dd></dd>
          @endif
        </dl>
      </div>
      </section>
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
      <form method="POST" action="{{ route('addCart') }}">
        @csrf
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
          @if($item['quantity'] <= 10 && $item['quantity'] > 0)
          <a class="dead_stock">残り在庫：{{ $item['quantity'] }}</a>
          @endif
        </div>

        @if($item['quantity'] >= 1)
        <button type="submit" class="item_cart_btn" name="action" value="submit">カートに入れる</button>
        <input name="item_id" value="{{ $item['id'] }}" type="hidden">
        @elseif($item['quantity'] <= 0)
        <div class="item_cart_btn">SOLD OUT</div>
        @endif
        @if(session()->has('message'))
        <div class="quantity_msg">{{session('message')}}</div>
        @endif

      </form>

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
@endsection