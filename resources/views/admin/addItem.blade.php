@extends('layouts.template')
@section('content')
<div class="admin_user">管理者でログイン中</div>
<div class="main_title">
  <h1>ADD ITEM</h1>
</div>
<form method="POST" action="{{ route('confirmItem') }}"
enctype="multipart/form-data">
  @csrf
  <div class="form-item">
  
    <p class="form-item-label">画像<span class ="red"> ※アップロード数は最大5枚</span></p>
    <div class="form-item-con1">
      <input type="file" id="img_path" name="img_path[]" multiple>
    </div>
    @if (session('flash_message'))
    <div class="flash_message">
      {{ session('flash_message') }}
    </div>
    @endif
    @error('img_path.*')
    <div class="alert">{{ $message }}</div>
    @enderror
    
    <p class="form-item-label">タイトル<span class ="red"> ※</span></p>
    <div class="form-item-con">
      <input type="text" class="input_text1" name=title value="{{ old('title') }}" placeholder="例）Relax Fit SHIRT">
    </div>
    @error('title')
    <div class="alert">{{ $message }}</div>
    @enderror

    <p class="form-item-label">商品情報<span class ="red"> ※</span></p>
    <div class="form-item-con">
      <textarea class="input_text1" rows="5" cols="33" name=info placeholder="例）適度な緩さが魅力のシンプルなオンブレチェックネルシャツ。柔らかく薄手のネル素材を使用し、オールシーズン着用可能。">{{ old('info') }}</textarea>
    </div>
    @error('info')
    <div class="alert">{{ $message }}</div>
    @enderror

    <p class="form-item-label">カラー<span class ="red"> ※</span></p>
    <div class="form-item-con">
      <input type="text" class="input_text1" name=color value="{{ old('color') }}" placeholder="例）BLUE">
    </div>
    @error('color')
    <div class="alert">{{ $message }}</div>
    @enderror

    <p class="form-item-label">素材<span class ="red"> ※</span></p>
    <div class="form-item-con">
      <input type="text" class="input_text1" name=material value="{{ old('material') }}" placeholder="例）綿100%">
    </div>
    @error('material')
    <div class="alert">{{ $message }}</div>
    @enderror

    <p class="form-item-label">サイズ<span class ="red"> ※</span></p>
    <div class="form-item-con1">
      <select name="size">
        <option value="S" selected>S</option>
        <option value="M">M</option>
        <option value="L">L</option>
      </select>
    </div>

    <p class="form-item-label">価格<span class ="red"> ※</span></p>
    <div class="form-item-con">
      <input type="number" class="input_text1" name=price value="{{ old('price') }}" placeholder="例）5980">
    </div>
    @error('price')
    <div class="alert">{{ $message }}</div>
    @enderror

    <p class="form-item-label">カテゴリー<span class ="red"> ※</span></p>
    <div class="form-item-con1">
      <select id="category" name="category">
      @foreach ($categories as $category)
        <option value="{{ $category->name }}" @if(old('category') == $category->name) selected @endif>
          {{ $category->name }}
        </option>
      @endforeach
      </select>
    </div>

    <p class="form-item-label">在庫数<span class ="red"> ※</span></p>
    <div class="form-item-con">
      <input type="number" class="input_text1" name=quantity value="{{ old('quantity') }}" placeholder="例）100">
    </div>
    @error('quantity')
    <div class="alert">{{ $message }}</div>
    @enderror

    <p class="form-item-label">商品番号<span class ="red"> ※</span></p>
    <div class="form-item-con">
      <input type="text" class="input_text1" name=part_number value="{{ old('part_number') }}" placeholder="例）12345">
    </div>
    @error('part_number')
    <div class="alert">{{ $message }}</div>
    @enderror

    <div class="item-confirm-btn">
      <button type="submit" class="confirm_btn">入力内容確認</button>
    </div>
  </div>
</form>

@endsection