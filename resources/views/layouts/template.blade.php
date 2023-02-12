<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <title>@yield('title')</title>
  <script src="{{ asset('js/app.js') }}" defer></script>
  
  
</head>
<body>
<header>
  <div class="header_left">
    <div class="company">
      <a href="{{ route('home') }}" class="company_title">MARKE</a>
    </div>
  </div>
  <div class="header_right flex">
    <ul class="nav">
      <li class="has-sub">
        <a href="/member"><img src="/images/user.png" width="25" height="25"></a>
        <ul class="sub">
          @guest
          <li>
            <a href="/login">ログイン</a>
          </li>
          @endguest
          <li>
          @auth 
            <a href="/member">会員情報</a>
          </li>
          <li>
            <a href="/logout">ログアウト</a>
          </li>
          @endauth
        </ul>
      </li>
    </ul>
    <a class="header_right_con" href=""><img src="/images/cart.png" width="30" height="30"></a>
    <div id="nav-wrapper" class="nav-wrapper header_right">
      <div class="hamburger" id="js-hamburger">
        <span class="hamburger__line hamburger__line--1"></span>
        <span class="hamburger__line hamburger__line--2"></span>
        <span class="hamburger__line hamburger__line--3"></span>
      </div>
      <nav class="sp-nav">
        <ul>
          <li><a href="/marke">TOP</a></li>
          <li><a href="/marke/about">ABOUT</a></li>
          <li><a href="/marke/news">NEWS</a></li>
          <li><a href="/marke/contact">CONTACT</a></li>
        </ul>
      </nav>
      <div class="black-bg" id="js-black-bg"></div>
    </div>
  </div>
</header>

  <main>
    @yield('content')
  </main>

  <footer>
    <div class="flex justify-center">
        <a class="link_con" href=""><img src="/images/twitter.jpg" width="25" height="25"></a>
        <a class="link_con" href=""><img src="/images/instagram.jpg" width="25" height="25"></a>
    </div>
    <div class="flex">
      <a class="important_con" href="">プライバシーポリシー</a>
      <a class="important_con" href="">特定商取引に基づく表記</a>
    </div>
    <div class="copy_light">&copy 2023 MARKE inc.</div>
  </footer> 

<script>
  window.onload = function () {
    var nav = document.getElementById('nav-wrapper');
    var hamburger = document.getElementById('js-hamburger');
    var blackBg = document.getElementById('js-black-bg');

    hamburger.addEventListener('click', function () {
        nav.classList.toggle('open');
    });
    blackBg.addEventListener('click', function () {
        nav.classList.remove('open');
    });
  };

  var parent = document.querySelectorAll(".has-sub");

  var node = Array.prototype.slice.call(parent, 0);

  node.forEach(function (element) {
    element.addEventListener(
      "mouseover",
      function () {
        element.querySelector(".sub").classList.add("active");
      },
      false
    );
    element.addEventListener(
      "mouseout",
      function () {
        element.querySelector(".sub").classList.remove("active");
      },
      false
    );
  });
</script>
<script src="https://js.stripe.com/v3/"></script>
<script>
  var stripe_key = '{{ config('payment.stripe_key') }}';
</script>
<script src="{{ asset('js/payment.js') }}"></script>
</body>
</html>