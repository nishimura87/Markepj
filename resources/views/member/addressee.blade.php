@extends('layouts.template')
@section('content')
<x-guest-layout>
  <div class="main_title">
    <h1>ADDRESSSEE</h1>
  </div>
  <x-auth-card>
    <form method="POST" action="{{ route('storeAddressee') }}">
      @csrf
      <div class="register_title">
        お届け先
      </div>

      @if(!empty($addressee))
      <div class="form-item">
        <p class="form-item-label">お名前<span class ="red"> ※</span></p>
        <div class="form-item-con">
          <input type="text" class="input_text1" name=name value="{{ $addressee['name'] }}">
        </div>
        @error('name')
        <div class="alert">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-item">
        <p class="form-item-label">フリガナ<span class ="red"> ※</span></p>
        <div class="form-item-con">
          <input type="text" class="input_text1" name=kana value="{{ $addressee['kana'] }}">
        </div>
        @error('kana')
        <div class="alert">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-item">
        <p class="form-item-label">郵便番号<span class ="red"> ※</span></p>
        <div class="form-item-con">
          <a class="postcode_mark">〒</a>
          <input type="text" class="input_text1" name=postcode value="{{ $addressee['postcode'] }}">
        </div>
        @error('postcode')
        <div class="alert">{{ $message }}</div>
        @enderror
      </div>
      
      <div class="form-item">
        <p class="form-item-label">住所<span class ="red"> ※</span></p>
        <div class="form-item-con">
        <input type="text" class="input_text1" name=address value="{{ $addressee['address'] }}">
        </div>
        @error('address')
        <div class="alert">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-item">
        <p class="form-item-label">建物名</p>
        <div class="form-item-con">
          <input type="text" class="input_text1" name=building value="{{ $addressee['building'] }}">
        </div>
      </div>

      <div class="form-item">
        <p class="form-item-label">電話番号<span class ="red"> ※</span></p>
        <div class="form-item-con">
          <input type="text" class="input_text1" name=phone_number value="{{ $addressee['phone_number'] }}">
        </div>
        @error('phone_number')
        <div class="alert">{{ $message }}</div>
        @enderror
      </div>
      @endif

      @if(empty($addressee))
      <div class="form-item">
        <p class="form-item-label">お名前<span class ="red"> ※</span></p>
        <div class="form-item-con">
          <input type="text" class="input_text1" name=name value="{{ old('name') }}">
        </div>
        @error('name')
        <div class="alert">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-item">
        <p class="form-item-label">フリガナ<span class ="red"> ※</span></p>
        <div class="form-item-con">
          <input type="text" class="input_text1" name=kana value="{{ old('kana') }}">
        </div>
        @error('kana')
        <div class="alert">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-item">
        <p class="form-item-label">郵便番号<span class ="red"> ※</span></p>
        <div class="form-item-con">
          <a class="postcode_mark">〒</a>
          <input type="text" class="input_text1" name=postcode value="{{ old('postcode') }}">
        </div>
        @error('postcode')
        <div class="alert">{{ $message }}</div>
        @enderror
      </div>
      
      <div class="form-item">
        <p class="form-item-label">住所<span class ="red"> ※</span></p>
        <div class="form-item-con">
        <input type="text" class="input_text1" name=address value="{{ old('address') }}">
        </div>
        @error('address')
        <div class="alert">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-item">
        <p class="form-item-label">建物名</p>
        <div class="form-item-con">
          <input type="text" class="input_text1" name=building value="{{ old('building') }}">
        </div>
      </div>

      <div class="form-item">
        <p class="form-item-label">電話番号<span class ="red"> ※</span></p>
        <div class="form-item-con">
          <input type="text" class="input_text1" name=phone_number value="{{ old('phone_number') }}">
        </div>
        @error('phone_number')
        <div class="alert">{{ $message }}</div>
        @enderror
      </div>
      @endif
      

      <div class="addressee_margin"></div>
      <div class="addressee_fix">
        <button class="addressee_fix_btn">登録する</button>
      </div>
    </form>
  </x-auth-card>
</x-guest-layout>
@endsection