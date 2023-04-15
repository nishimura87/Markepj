# アプリケーション名

-   Marke
-   ファッション EC サイトで商品販売ができるアプリケーション
<img width="1423" alt="ホーム画像" src="https://user-images.githubusercontent.com/107283362/232210746-5a58ba65-cf87-4f80-8cd6-aa9f40341361.png">

## 作成した目的

-   COACHTECH Pro 再受験・ポートフォリオのため

## アプリケーション URL

-   http://54.173.240.254/marke

## 機能一覧

1. ユーザー認証(登録・ログイン・ログアウト・パスワードリセット)
2. ログインパスワード変更
3. 商品情報(閲覧・追加・更新・削除)
4. ニュース情報(閲覧・追加・更新・削除)
5. 店舗情報閲覧(Google マップ実装)
6. カート(閲覧・追加・更新・削除)
7. 決済(クレジットカードの登録・更新・削除・決済)
8. お問い合わせ(メール受信可能)
9. SNS 連動(Twitter・Instagram へ遷移可能)
10. 無限スクロール
11. 購入履歴閲覧
12. お届け先登録

## 使用技術（実行環境）

-   Laravel:8.83.27
-   php:4.1.16

## テーブル設計
![テーブル設計](https://user-images.githubusercontent.com/107283362/232210941-c90bcc02-73c6-4201-94e4-6897e6d73c67.jpg)

## ER 図
<img width="561" alt="ER図" src="https://user-images.githubusercontent.com/107283362/232212491-732b4657-2e7b-4e4f-abaa-eed61299d7f9.png">
## 他に記載することがあれば記述する

1. 管理者ログイン方法

-   メールアドレス：marke.b.2023@gmail.com
-   パスワード：admin2023

2. ダミークレジット情報

-   カード番号：4242 4242 4242 4242
-   セキュリティーコード：数字 3 桁 (例)123
-   有効期限：現在日付以降を設定
-   カード名義：ローマ字で名前・苗字など
