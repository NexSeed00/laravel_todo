# 編集機能作成
ここでは編集機能を実装します。  
編集機能では実施することが大きくわけて2つあります。  
1. 編集画面の作成
2. 内容の更新(対象のデータを1でユーザーが投稿した内容に更新する)

## 編集画面の表示
### ルーティング

編集画面を表示するためのルートを定義します。  
```php
Route::get('diaries/{diary}/edit', 'DiaryController@edit')->name('diary.edit'); 
```

一覧ページに編集ボタンを作成します。  
```php
<p>{{ $diary->created_at }}</p>
<a class="btn btn-success" href="{{ route('diary.edit', ['diary' => $diary->id]) }}">編集</a>
```

編集ボタンをクリックして以下のエラーが表示されればOKです。  
`Method App\Http\Controllers\DiaryController::edit does not exist.`

### コントローラー / モデル
編集画面表示用のメソッドをコントローラーに追加します。  

```php
    public function edit(Diary $diary)
    {
        dd($diary);
    }
```

Diaryクラスのインスタンスが画面に表示されます。  
`attributes` という箇所を展開すると、  
選択したレコードのデータが表示されていると思います。  

編集画面には編集対象のデータを表示する必要があるため、  
**ルートモデルバインディング** を使用して、  
Diaryモデルから対象のレコードを取得しています。  

### ビュー
#### ビューの作成
編集画面用のビューを作成します。  
`resources/views/diaries/` ディレクトリに `edit.blade.php` を作成して以下の内容をコピーしてください。
```php
// view/diaries/edit.blade.php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>編集画面</title>
</head>
<body>
    <section class="container m-5">
        <div class="row justify-content-center">
            <div class="col-8">
                <form action="" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="title">タイトル</label>
                        <input type="text" class="form-control" name="title" id="title">
                    </div>
                    <div class="form-group">
                        <label for="title">本文</label>
                        <textarea class="form-control" name="body" id="body"></textarea>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">更新</button>
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
editメソッドの中身を修正します。  
```php
    public function edit(Diary $diary)
    {
        return view('diaries.edit', compact('diary'));
    }
```

編集ボタンをクリックして、タイトルと本文の入力欄が表示されればOKです。

#### 編集対象のデータを画面に表示
タイトルと本文の入力欄が空になっているため、  
編集対象のデータを表示します。  

titleとbodyの入力欄をそれぞれ以下のように修正します。  

```php
<input type="text" class="form-control" name="title" id="title" value="{{ old('title', $diary->title) }}">

<textarea class="form-control" name="body" id="body">{{ old('body', $diary->body) }}</textarea>
```

`old()` は新規作成の際にバリデーションに引っかかった際に値を保持するために使用しました。  
値を表示するのみであれば、  `value="{{ $diary->title }}"` でも可能ですが、  
編集でも後ほどバリデーションするため、最初から `old` を使用します。  
引数を2つとっており、 1つ目が `ユーザーが入力した値(変更した値)` 、 2つ目が `デフォルトの値` 、
ユーザーが何も入力してない場合に表示される値です。  


## 更新処理
### ルーティング
```php

```

### コントローラー
### モデル
### ビュー
### バリデーション