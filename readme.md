
## What is this Project ?
出張着付の予約を管理するアプリです。  
「予約一覧」「講師一覧」「連絡者一覧」画面があり、
そこから登録や編集、内容の詳細を確認することができます。

## Requirement
https://readouble.com/laravel/5.8/ja/installation.html#server-requirements を参照してください。

## Set Up
```
$ cd kitsukeApp
$ composer install
$ cp .env.example .env
$ php artisan key:generate
$ php artisan migrate:refresh --seed
```

## How to run Task Application
 `$ php artisan serve `  
http://localhost/kitsuke/reservations
にアクセスすると、 予約一覧画面が表示されます。 



