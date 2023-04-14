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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
        <a class="sub-item" href="{{ route('infoUser') }}"><img src="/images/user.png" width="25" height="25"></a>
        <ul class="sub">
          @guest
          <li>
            <a class="sub-item" href="/login">ログイン</a>
          </li>
          @endguest
          <li>
          @auth 
            <a class="sub-item" href="/member">会員情報</a>
          </li>
          <li>
            <a class="sub-item" href="/logout">ログアウト</a>
          </li>
          @endauth
        </ul>
      </li>
    </ul>
    <a class="header_right_con" href="{{ route('cartList') }}"><img src="/images/cart.png" width="30" height="30"></a>
    <div id="nav-wrapper" class="nav-wrapper header_right">
      <div class="hamburger" id="js-hamburger">
        <span class="hamburger__line hamburger__line--1"></span>
        <span class="hamburger__line hamburger__line--2"></span>
        <span class="hamburger__line hamburger__line--3"></span>
      </div>
      <nav class="sp-nav">
        <ul class="sp-nav-ul">
          <li><a href="/marke" class="hamburger_txt">TOP</a></li>
          <li><a href="/marke/about" class="hamburger_txt">ABOUT</a></li>
          <li><a href="/marke/news" class="hamburger_txt">NEWS</a></li>
          <li><a href="/marke/contact" class="hamburger_txt">CONTACT</a></li>
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
      <a class="link_con" href="https://twitter.com/Marke2023"><img src="/images/twitter.jpg" width="25" height="25"></a>
      <a class="link_con" href="https://z-p15.www.instagram.com/marke2023_test/"><img src="/images/instagram.jpg" width="25" height="25"></a>
    </div>
    <div class="flex">
      <a class="important_con" href="/marke/privacy">プライバシーポリシー</a>
      <a class="important_con" href="/marke/law">特定商取引に基づく表記</a>
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
<script>
  if(window.matchMedia("(max-width:768px)").matches){
        var init = 9  //初期表示数
        var more = 3  //追加表示数
      }else if (window.matchMedia("(min-width:769px)").matches){
        var init = 10  //初期表示数
        var more = 5  //追加表示数
      }

  // 初期表示数以降のリストを非表示に
  $(".item_list li:nth-child(n+" + (init+1) + ")").hide()

  //初期表示数以下であればMoreボタンを非表示
  $(".item_list").filter(function(){
      return $(this).find("li").length <= init
  }).find(".more-btn").hide()    

  // Moreボタンクリックで指定数表示
  $(".more-btn").on("click",function(){
      let this_list = $(this).closest(".item_list")
      this_list.find("li:hidden").slice(0,more).slideToggle()

      if(this_list.find("li:hidden").length == 0){
          $(this).fadeOut()
      }
  })
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(function()
{
	$(".sub_img dt").eq(0).addClass("select");
	$(".sub_img img").click(function()
	{
		var img = $(this).attr("src");

		$(".sub_img dt").removeClass("select");
		$(this).parent().addClass("select");

		$(".main_img img").fadeOut(500, function()
		{
			$(this).attr("src", img),
			$(this).fadeIn(500)
		});
	});
});
</script>
</body>
</html>