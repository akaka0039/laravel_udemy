## udemy Laravel講座

## ダウンロード方法

git clone
git clone https://github.com/akaka0039/laravel_udemy.git

git clone ブランチを指定してダウンロードする場合
git clone -b ブランチ名 https://github.com/akaka0039/laravel_udemy.git

もしくはzipファイルでダウンロードしてください

## インストール方法
- cd laravel_umarche
- composer install
- npm install
- npm run dev

.env.example　をコピーして .envファイルを作成

.envファイルの中の下記をご利用の環境に合わせて変更してください
- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=laravel_umarche
- DB_USERNAME=umarche
- DB_PASSWORD=password

XAMPP/MAMPまたは他の環境開発でDBを起動した後に

php artisan migrate:fresh --seed

と実行してください。（データベーステーブルとダミーデータが追加されればOk）

最後に
php artisan key:generate
と入力してキー生成後、

php artisan serve
で簡易サーバーを立ち上げ、表示確認してください

## インストール後の実施方法

画像のダミーデータは
public/imagesフォルダ内に
sample1.jpg~sample6.jpgとして
保存しています。

php artisan storage:linkで
storageフォルダにリンク後、

storage/app/public/productsフォルダ内に
保存すると表示されます。
（productsフォルダがない場合は作成してください）

## section7の補足

決済のテストとしてstripeを利用しています
必要な場合は.envにstripeの情報を追記してください


## section8の補足

メールテストとしてmailtrapを利用しています
必要な場合は.envにmailtrapの情報を追記してください

メール処理には時間がかかるので
キューをしています。

必要な場合は php artisan queue:workで
ワーカーを立ち上げて動作確認をするようにしてください


※理解を深めるため、日々コメントを追記