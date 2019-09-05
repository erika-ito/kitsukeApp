
## What is this Project ?
出張着付の予約を管理するアプリです。  
「予約一覧」「講師一覧」「連絡者一覧」画面があり、
そこから登録や編集、内容の詳細を確認することができます。

## Requirement
* Laravel
https://readouble.com/laravel/5.8/ja/installation.html#server-requirements
* Vagrant
https://www.vagrantup.com/downloads.html
* VirtualBox
https://www.virtualbox.org/
* Homestead


## Set Up
開発環境の設定を行います。  
VagrantとVirtualBoxをインストールしたら、以下の手順を実行してください。 
* vagrat boxの作成（ダウンロード） 
```
$ cd Users/ユーザー名
$ vagrant box add laravel/homestead
```
 `Enter your choice` と訊かれたら、virtualboxの番号を選択する

* Homesteadのダウンロード
```
$ mkdir app
$ cd app
$ git clone https://github.com/laravel/homestead.git Homestead
```
任意のディレクトリ（app）を作成し、Homesteadをダウンロードします。

* 設定ファイルの作成と編集
```
$ cd Homestead
$ bash init.sh
$ vim Homestead.yaml
```
 `folders: map: ~/code`部分を `folders: map: ~/app` へ、  
 `sites: to: /home/vagrant/code/public`部分を  
 `sites: to: /home/vagrant/code/KitsukeApp/public` へ書き換える。

* SSH鍵ファイルの作成（鍵がない場合）
```
cd ~
ssh-keygen -t rsa
```

* 仮想マシンの起動とgit clone
```
$ cd Users/ユーザー名/app/Homestead
$ vagrant up
$ vagrant ssh
(以下仮想マシン内)
$ cd code
$ git clone https://github.com/erika-ito/kitsukeApp.git
```

* git clone後の設定
```
$ cd kitsukeApp
$ composer install
$ cp .env.example .env
$ php artisan key:generate
$ php artisan migrate:refresh --seed
```
パッケージのインストール、envファイルの作成（コピー）、  
アプリケーションキーの作成、マイグレーション・シーダーの実行などを行う。

## How to run Task Application
仮想マシンを起動した状態でhttp://192.168.10.10/kitsuke/reservations
にアクセスすると、 予約一覧画面が表示されます。 



