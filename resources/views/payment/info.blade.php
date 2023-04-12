@extends('layouts.template')
@section('content')
</style>
<div class="main_title">
  <h1>MEMBER INFOMATION</h1>
</div>
<div class="card-header">
  現在登録しているクレジットカード
</div>
<div class="card">
  @if (session('status'))
  <div class="alert alert-success" role="alert">
    {{ session('status') }}
  </div>
  @endif

  @if (session('success'))
    <div class="alert alert-success" role="alert">
      {{ session('success') }}
    </div>
  @endif

  @if (session('errors'))
    <div class="alert alert-danger" role="alert">
      {{ session('errors') }}
    </div>
  @endif

  <div class="form-group">
    @isset($defaultCard)
    <ul class="list-group">
      <li class="list-group-item"><span>カード番号：</span><span>{{$defaultCard["number"]}}</span></li>
      <li class="list-group-item"><span>カード有効期限（月/年):</span><span>{{$defaultCard["exp_month"]}}/{{$defaultCard["exp_year"]}}</span></li>
      <li class="list-group-item"><span>カード名義：</span><span>{{$defaultCard["name"]}}</span></li>
      <li class="list-group-item"><span>カードブランド：</span><span>{{$defaultCard["brand"]}}</span></li>
    </ul>
    @else
      <p>現在登録されているクレジットカードはありません。</p>
    @endif
  </div>

  @isset($defaultCard)
  <a class="btn-primary" href="{{route('createPayment')}}">カードを変更</a>

  <form action="{{route('destroyPayment')}}" method="POST">
    @csrf
    <button class="btn-danger">カードを削除</button>
  </form>
  @else
  <a class="btn-primary" href="{{route('createPayment')}}">カードを新規登録</a>
  @endif
  <a class="payment_back_btn" href="{{route('infoUser')}}">会員情報に戻る</a>
</div>

@endsection