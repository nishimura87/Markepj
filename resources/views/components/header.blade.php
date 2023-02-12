<header>
  <div class="header_left">
    <div class="company">
      <p class="company_title">MARKE</p>
    </div>
  </div>
  <div class="header_right flex">
    <a class="header_right_con" href=""><img src="/images/user.png" width="25" height="25"></a>
    <a class="header_right_con" href=""><img src="/images/cart.png" width="30" height="30"></a>
    <div id="nav-wrapper" class="nav-wrapper header_right">
      <div class="hamburger" id="js-hamburger">
        <span class="hamburger__line hamburger__line--1"></span>
        <span class="hamburger__line hamburger__line--2"></span>
        <span class="hamburger__line hamburger__line--3"></span>
      </div>
      <nav class="sp-nav">
        <ul>
          <li>TOP</li>
          <li>ABOUT</li>
          <li>NEWS</li>
          <li>ONLINE SHOP</li>
          <li>CONTACT</li>
        </ul>
      </nav>
      <div class="black-bg" id="js-black-bg"></div>
    </div>
  </div>
</header>

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
</script>