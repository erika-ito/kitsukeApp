
## What is this Project ?
出張着付の予約を管理するアプリです。
「予約一覧」「講師一覧」「連絡者一覧」があり、
そこから登録・編集や、内容の詳細を確認することができます。

## Requirement
https://readouble.com/laravel/5.8/ja/installation.html#server-requirements

## Set Up
```
$ cd kitsukeApp
$ composer install
$ cp .env.example .env
$ php artisan key:generate
$ php artisan migrate:refresh --seed
```

## How to run Task Application
http://localhost/kitsuke/reservations
にアクセスすると、 予約一覧画面が表示されます。 



