# 事前準備

## Laravelのインストール
以下のコマンドを実行  
※Laravelをインストールしたいディレクトリで実行
```
composer create-project laravel/laravel --prefer-dist ./
```

## DBを利用する準備
1. MySQLにDBを作成
PHPMyAdminを利用してDBを作成  
※DB名は任意ですが、カリキュラムでは `Diary` というDBを作成した前提で進めます。  

2. .envファイルの内容を修正/追加
※DB_SOCKET以外は内容の修正、DB_SOCKETは追記してください。
   ```
   DB_DATABASE=Diary
   DB_USERNAME=root
   DB_PASSWORD=
   # MacでDBにXAMPPのMySQLを追加してる場合のみ追加
   DB_SOCKET=/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock
   ```

## Gitで管理
LaravelをインストールしたディレクトリをGit管理にしましょう。  
`.gitignore` に記載されているファイルはGitで管理されません。  
これらのファイルを管理しない理由は、管理する必要がないためです。  
例えば、 `vendorディレクトリ` と `.env` は管理されません。  

`vendor` にはインストールされたライブラリが保存されますが、  
`compoer.json` にプロジェクトで使用されるライブラリが記載されており、  
`composer.json` があれば同じ内容の `vendor` は作成できます。  
そのため、たくさんのファイルが保存されていて、容量が大きい `vendor` はGitで管理せず、  
`composer.json` をGitで管理します。