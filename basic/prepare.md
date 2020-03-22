# Laravel基本

## インストール
### 前提
- composerがインストールされていること

以下のコマンドを実行したフォルダに `project_name` フォルダができます。  
`project_name` の名前は任意です。  
自分が作成するWebサービスなどの名前にします。  
```
omposer create-project --prefer-dist laravel/laravel project_name

```

### 参考リンク
[インストール](https://readouble.com/laravel/6.x/ja/installation.html)

## ブラウザでの確認
プロジェクトのルートディレクトリで以下のコマンドを実行することで、  
開発用のサーバが起動します。  
サーバが起動後、 `localhost:8000` でブラウザからTOPページが確認できます。  
```
php artisan serve
```

## DBの準備
1. プロジェクトで使用するDBを作成(PHPMyAdminなどから実行)
  - 照合順序は `utf8mb4` を選択
  - テーブルの作成は不要(Laravelの機能を使用して作成するため)
2. .envファイルのDB関連の箇所をDBの内容に沿って修正
  - DB_SOCKET部分はMacでXAMPPを使用する場合のみ必要
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_name
DB_USERNAME=root
DB_PASSWORD=
DB_SOCKET=/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock
```

## Gitで管理
忘れずにGit管理しましょう