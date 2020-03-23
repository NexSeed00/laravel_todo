# 新規投稿機能の作成
ここでは新規投稿機能を実装します。  
新規投稿機能では実施することが大きくわけて2つあります。  
1. 新規投稿画面の作成
2. 投稿内容を保存(1でユーザーが投稿した内容をDBに保存する)



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
まずはルートを追加します。  

```php
Route::post('diaries/create', 'DiaryController@store')->name('diary.store'); // 保存処理
```
今回保存処理が実行されるのは、  
投稿画面で、投稿ボタンをクリックしたときになるので、  
投稿ボタンがクリックされたときの移動先(formタグのaction)に上記URLを指定します。  

```php
<form action="{{ route('diary.store') }}" method="POST">
```

上記変更を加えたあとに投稿ボタンをクリックしてください。  
以下のエラーが表示されればOKです。  

```
Method App\Http\Controllers\DiaryController::store does not exist.
```

#### action="{{ route('diary.store') }}に関して
フォームのアクションには、遷移先のページのURLを入力することは既に認識されているかと思います。  

`action="{{ route('diary.store') }}" `も遷移先を指定してます。  
`route('diary.store')`と書くことこで、ルートに指定した`name`のURLに変換されます。  

```php
// routes/web.php
Route::get('/', 'DiaryController@index')->name('diary.index');

Route::get('diaries/create', 'DiaryController@create')->name('diary.create');

Route::post('diaries/create', 'DiaryController@store')->name('diary.store');
```

上記が現在のルートです。  
それぞれ `->name('xxx.yyy')` となってますが、  
Laravelでは`<form>`や`<a>`で遷移先を指定するときに、 `route('xxx.yyy')` とすることで、  
リンクが対応したURLになります。  

今回の場合は、 `{{ route('diary.store') }}` なので、URLは `diary/create` となります。  
また、formに指定されているメソッドは `POST` のため、  
投稿ボタンを押した場合は保存処理が実行されることになります。

#### @csrfに関して
Laravelには一般的な攻撃を防ぐためのセキュリティ対策があらかじめ準備されています。  
そのうちの1つがCSRF対策です。  

CSRFの詳細は説明は本論とずれてしまうため割愛しますが、  
簡単にいうと、ユーザーの意図しない不正な書き込みなどが実施できる脆弱性、  
またはその脆弱性を利用した攻撃のことです。  

Laravelではその脆弱性を防ぐのは非常に簡単で、  
フォームの中に`@csrf`と記述するだけです。    
`<form action="{{ route('diary.store') }}" method="POST">` の下に  
`@csrf` と記述されていることが確認できると思います。
また、入力漏れがないように、`@csrf`を書いてない場合はフォームの送信時に `419` というエラーが表示されます。  

##### 参考リンク

[CSRF保護](https://readouble.com/laravel/6.x/ja/csrf.html)

### コントローラー
DiaryControllerに以下のメソッドを追加しましょう。  

```php
public function store()
{
    dd('ここに保存処理');
}
```

ブラウザをリロードして、`ここに保存処理` という文字が表示されればOKです。  

今回作成した `storeメソッド` では
1. DBにデータを保存
2. 一覧画面に戻る
の2つを行います。  

### モデル
まずはDBにデータを保存する処理をします。  

`storeメソッド` に以下の通り追記します。  
```php
    public function store(Request $request)
    {
        Diary::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);
    }
```

`Diary.php` に以下の通り追記します。
```php
  protected $fillable = ['title', 'body'];
```

Diaryクラスの `createメソッド` でデータの保存をしています。  
`createメソッド` は連想配列を引数にとり、  
keyにDBのカラム名、valueにそのカラムに保存したいデータをとります。  

今回保存したいデータは **ユーザーが入力したデータになります**  
ユーザーが入力したデータは変数 `$request` に入っています。  
`$request->inputタグのname属性` と入力すると、  
ユーザーが入力した値が取得できます。  
今回の場合は、name属性が `title` と `body` なので、  
`$request->title` と `$request->body` となっています。

#### 参考リンク
fillableに関しては以下のリンクを参照してください。  
[複数代入](https://readouble.com/laravel/6.x/ja/eloquent.html?header=%25E8%25A4%2587%25E6%2595%25B0%25E4%25BB%25A3%25E5%2585%25A5)


### ビュー

一覧画面に戻るだけなので新たなビューの作成はありません。  
`storeメソッド` に `return redirect()->route('diary.index');` を追加してください。  
`redirect()->route('diary.index');` が何をしているかというと、  
`web.php` の `diary.index` というnameのルートにリダイレクトしているということになります。  

```php
    public function store()
    {
        // dd('ここに保存処理');

        return redirect()->route('diary.index');
    }
```



### バリデーション