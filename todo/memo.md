## 手順
- マイグレーション
- テストデータの作成
- モデルの作成
- 不要なファイル、コードの削除
- 一覧表示
- 新規作成
- 編集
- 削除
- エラーハンドリング
- 認証機能
- 認可機能
- 画像投稿機能
- マイページ
- ブックマーク
- メモ(コメント)
- テスト


### マイグレーション
```
# ファイルの作成
php artisan make:migration create_tasks_table

# ファイルの編集

# マイグレーション(編集したファイル)実行
php artisan migrate:fresh
```

### テストデータの作成
```
# ファイルの作成
php artisan make:seeder UsersTableSeeder
php artisan make:seeder TasksTableSeeder

# 作成したファイルの読み込み
composer dump-autoload

# ファイルの編集

# シーディング
php artisan db:seed
```


### モデルの作成
```
# ファイルの作成
php artisan make:model Task

# ファイルの編集
```

### 不要なファイル、コードの削除
```
# view
# route
```

### 一覧表示
```
# route

# controller
## 作成
php artisan make:controller TaskController

## 編集

# model

# view
npm i
npm run dev
npm run watch

```

### 新規作成
```
routeの作成

```

### 編集

### 削除

### エラーハンドリング
- バリデーション
```
php artisan make:request TaskRequest

```
- 404
```
ルートモデルバインディング
```


### 認証機能
```
composer require laravel/ui --dev
php artisan ui:auth bootstrap
不要なファイルとコードの削除
```

### 認可機能
```

```

### ブックマーク
```
php artisan make:migration create_bookmarks_table 

## マグレーションファイル編集

## マイグレーション
php artisan migrate
```

### コメント
```
```

### テスト
```
php artisan make:test TaskControllerTest

不要なテスト削除

テスト作成
```
