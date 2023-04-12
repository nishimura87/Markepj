***********************************<br>
本メールはお客様のご注文情報時に送信される、自動メールです。<br>
ショップからの確認の結果、または商品の発送をもって再度ご連絡いたします。<br>
***********************************<br><br>

Markeをご利用いただき、まことにありがとうございます。<br>
下記内容にてご注文を承りましたのでご連絡申し上げます。<br><br>

************************<br>
ご注文番号：{{ $code }}<br><br>
■ご注文内容<br>
@foreach($orders as $order)
{{ $order->item->title }}　
¥{{ number_format($order->price) }}×{{ $order->quantity }}<br>
小計:¥{{ number_format($order->price * $order->quantity) }}<br><br>
@endforeach
送料:¥250<br>
ご請求金額:¥{{ number_format($totalData) }}<br>
************************<br>
■ご注文者情報<br>
〒{{ $user->postcode}}<br>
{{ $user->address }}<br>
{{ $user->building }}<br>
{{ $user->name }}　様<br>
TEL:{{ $user->phone_number }}<br>
e-mail:{{ $user->email }}<br>
************************<br>
■配送先情報<br>
@if($addressee)
〒{{ $addressee->postcode}}<br>
{{ $addressee->address }}<br>
{{ $addressee->building }}<br>
{{ $addressee->name }}　様<br>
TEL:{{ $addressee->phone_number }}<br>
@else
〒{{ $user->postcode}}<br>
{{ $user->address }}<br>
{{ $user->building }}<br>
{{ $user->name }}　様<br>
TEL:{{ $user->phone_number }}<br>
e-mail:{{ $user->email }}<br>
@endif
************************<br>
■お支払い方法：クレジットカード支払い<br>
カード番号：{{$defaultCard["number"]}}<br>
カード有効期限（月/年):{{$defaultCard["exp_month"]}}/{{$defaultCard["exp_year"]}}<br>
カード名義：{{$defaultCard["name"]}}<br>
カードブランド：{{$defaultCard["brand"]}}<br>
************************<br><br>

***********お問い合わせ***********<br>
メールによるお問い合わせ:marke.b.2023@gmail.com<br>
Marke:http://127.0.0.1:8000/marke/contact<br>
********************************