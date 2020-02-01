## 手順
- マイグレーション
- テストデータの作成
- モデルの作成
- 不要なファイル、コードの削除
- 一覧表示
- 新規作成
- 編集
- 削除
- 認証機能
- エラーハンドリング
- 画像投稿機能
- マイページ
- 検索機能
- ブックマーク
- メモ(コメント)


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
