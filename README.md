# coachtechフリマ

## 環境構築
**Dockerビルド**
1. `git clone git@github.com:Toriyamayoshihiro/test1.git
2. DockerDesktopアプリを立ち上げる
3. `docker-compose up -d --build`

> *MacのM1・M2チップのPCの場合、`no matching manifest for linux/arm64/v8 in the manifest list entries`のメッセージが表示されビルドができないことがあります。
エラーが発生する場合は、docker-compose.ymlファイルの「mysql」内に「platform」の項目を追加で記載してください*
``` bash
mysql:
    platform: linux/x86_64(この文追加)
    image: mysql:8.0.26
    environment:
```

**Laravel環境構築**
1. `docker-compose exec php bash`
2. `composer install`
3. 「.env.example」ファイルを 「.env」ファイルに命名を変更。
4. .envに以下を設定
``` text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=sample
MAIL_PASSWORD=sample
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=sample@laravel.jp
MAIL_FROM_NAME="${APP_NAME}"

STRIPE_KEY=pk_test_51SnHHkRom2OMSwxZzk5jb0RenZjgcBqUzp0NIbxa4Brh7NhpTx69Sv0k6qyfjRCHd7z5uevVwZ7tJLbTc3GjEP4k00EyoOcyy1
STRIPE_SECRET=sk_test_51SnHHkRom2OMSwxZ4wxM4rzShi9H1QZ39kbjntxdBz07x3lwdxDoqXrWKdZYKJi6iV98Rs4iXwEF2OA7nSQ96LqO00wrqIVDOF
```




5. アプリケーションキーの作成
``` bash
php artisan key:generate
```

6. マイグレーションの実行
``` bash
php artisan migrate
```

7. シーディングの実行
``` bash
php artisan db:seed
```

8. シンボリックリンクの実行
``` bash
php artisan storage:link
```
## 使用技術(実行環境)
- PHP8.1.33
- Laravel 8.83.29
- MySQL8.0.26
- nginx:1.21.1
- MailHog
- Stripe

## テスト実行方法
``` bash
php artisan test
または
vendor/bin/phpunit
```
## MailHog
会員登録・メール認証メールはMailHogで確認できます。

## Stripe
- .envにSTRIPE_KEYとSTRIPE_SECRETを設定すると、購入画面からStripe決済画面へ遷移します。

## テーブル仕様書

## ER図
![alt](erd.png)

## URL
- 開発環境：http://localhost/
- phpMyAdmin:：http://localhost:8080/
- mailhog::http://localhost:8025
