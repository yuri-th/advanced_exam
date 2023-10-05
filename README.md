# Rese（リーズ）<br>
ある企業のグループ会社の飲食店予約サービス<br>

◆ユーザーページ<br>

<img src="https://github.com/yuri-th/Advanced_exam/assets/117786989/76ec9549-b17b-4446-8d07-b88df590cea9" width="800"><br>

◆店舗情報管理ページ<br>

<img src="https://github.com/yuri-th/Advanced_exam/assets/117786989/914b133c-74e3-47af-af54-0bbd0c7cb8ec" width="800"><br>

◆店舗代表者管理ページ<br>

<img src="https://github.com/yuri-th/Advanced_exam/assets/117786989/07ca485d-b557-4d81-ab6d-d23e0a19a3ab" width="800"><br>

## 作成の目的<br>
外部の飲食店予約サービスを利用すると手数料がかかるので、自社で予約サービスを作って管理するため。<br>

・アプリケーションURL<br>
　http://localhost/<br>
  ※ログインには、名前とemail、パスワードでの会員登録が必要です。<br>
  
## 機能一覧<br>
会員登録/ログイン、ログアウト/メール認証/ユーザー情報取得/ユーザー飲食店お気に入り一覧取得/ユーザー飲食店予約情報取得/飲食店一覧取得/飲食店詳細取得/飲食店お気に入り追加、削除/飲食店予約情報追加、削除、変更/
店舗のエリア検索、ジャンル検索、店名検索/飲食店レビュー投稿（５段階評価とコメント）/認証、予約、レビュー投稿、店舗情報作成、店舗代表者作成の際のバリデーション機能/管理者、店舗代表者の管理画面/
お店の画像をストレージに保存/予約者にメールでお知らせを送信/予約日当日の朝に予約者にリマインダー送信/Stripe決済機能（メールに添付）/レスポンシブデザイン（ブレイクポイント768px)<br>

## 使用技術<br>
Laravel Framework 8.83.27/HTML/CSS/PHP/JavaScript<br>

## テーブル設計<br>
<img src="https://github.com/yuri-th/Advanced_exam/assets/117786989/62c49e2d-c48b-45cb-af72-bdf29e6204e2" width="800"><br>
&emsp;<img src="https://github.com/yuri-th/Advanced_exam/assets/117786989/09489295-cccb-4710-8945-c8bfea996bbf" width="760"><br>
&emsp;<img src="https://github.com/yuri-th/Advanced_exam/assets/117786989/75bf4112-fb4d-4e2c-8c32-d9488a4b38d2" width="760"><br>   

## ER図<br>
<img src="https://github.com/yuri-th/Advanced_exam/assets/117786989/938a3170-7eee-48b6-b8a4-e74ce6e43566" width="700"><br>

## 環境構築<br>
・プロジェクトをコピーしたいディレクトリにて「git clone <https://github.com/yuri-th/advanced_exam.git>」を行いプロジェクトをコピー<br>
・「cd advanced_exam/src」を行い.env.example のあるディレクトリに移動<br>
・.env.example をコピーし.env を作成<br>
・.env の DB_DATABASE=laravel_db DB_USERNAME=laravel_user DB_PASSWORD=laravel_pass を記載<br>
・docker-compose.yml の存在するディレクトリにて「docker-compose up -d --build」<br>
・php コンテナに入る「docker-compose exec php bash」<br>
・コンポーザのアップデートを行う「composer update」<br>
・APP_KEY の作成「php artisan key:generate」<br>
・テーブルの作成「php artisan migrate」または「php artisan migrate:fresh」<br>
※環境により「fresh」をつけないとテーブルを作成できない場合があります。<br>
・ユーザー、店舗データ、店舗責任者の作成「php artisan db:seed」<br>
・権限のエラーが出た場合は「sudo chmod -R 777 src」にて権限解除をしてください。<br>

以上でアプリの使用が可能です。「localhost/」にて店舗一覧、検索ページが開きます。<br>
認証メール、お知らせメール、リマインダーメールはMailtrapに届きます。<br>
リマインダーメールは予約日の当日9:00に届きます。<br>
管理者メールアドレスは、test@example.comです。<br>
お知らせメール、リマインダーメールにはStripe決済リンクがあります。<br>

## 追記事項<br>
・予約の削除はマイページの予約テーブルの×印を押すとできます。（予約日の前日までキャンセル可）<br>
・stripe決済は、<br>
  カード番号: 4242 4242 4242 4242<br>
  有効期限: 任意の未来の日付<br>
  CVC（セキュリティコード）: 任意の3桁の数字<br>
  で決済のテスト確認ができます。
　
    
