# 新規投稿機能の作成

## 新規投稿画面の作成
### ルーティング
一覧の作成同様まずはルートの設定をします。  
ルートでは、**①どのURL(メソッドも含む)の時に**、**②どのコントローラーの**、**③どのメソッドを使用するか**  
を決めます。  


新規投稿画面のルートを作成します。  
```php
// routes/web.php
Route::get('diaries/create', 'DiaryController@create')->name('diary.create'); 
```

ブラウザを更新して以下のエラーが表示されればOKです。  
`Method App\Http\Controllers\DiaryController::create does not exist.`

### コントローラー
コントローラー自体は一覧機能を作成するときに作成済みのため、  
ここではメソッドのみを追加します。  
今の段階では、コントローラーは基本的に1つのテーブルに対して、  
1つのコントローラーの考えてよいです。  

```php
    public function create()
    {
        dd('createメソッドが呼ばれました');
    }
```

`createメソッドが呼ばれました` という文字が画面に表示されればOKです。  

### モデル
データベースとのやり取りがないためモデルの作業はありません。  

### ビュー
#### ビューの作成
投稿画面用のビューを作成します。
`resources/views/diaries/` ディレクトリに `create.blade.php` を作成して以下の内容をコピーしてください。

```php
// resources/views/diaries/create.blade.php

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>新規投稿画面</title>
</head>
<body>
    <section class="container m-5">
        <div class="row justify-content-center">
            <div class="col-8">
                <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">タイトル</label>
                        <input type="text" class="form-control" name="title" id="title" />
                    </div>
                    <div class="form-group">
                        <label for="body">本文</label>
                        <textarea class="form-control" name="body" id="body"></textarea>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">投稿</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
```

#### 作成したビューの呼び出し
上記で作成したビューをコントローラーから呼び出します。  
createメソッドの中身を修正します。  
```php
    public function create()
    {
        return view('diaries.create');
    }
```

以下のURLにアクセスして投稿画面が表示されればOKです。  
http://localhost:8000/diaries/create

## 投稿内容を保存
### ルーティング
```php
Route::post('diaries/create', 'DiaryController@store')->name('diary.store'); // 保存処理
```

### コントローラー

### モデル

### ビュー
一覧画面に戻るだけなので新たなビューの作成はなし

### バリデーション