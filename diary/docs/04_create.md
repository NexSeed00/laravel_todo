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
Route::post('diaries', 'DiaryController@store')->name('diary.store'); // 保存処理
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

### おまけ
現在新規作成画面には直接URLを入力しないと遷移できないため、  
一覧ページに新規投稿ページへのリンクを作成します。  

```php
// view/diaries/index.blade.php
<body>
<a href="{{ route('diary.create') }}" class="btn btn-primary btn-block">
    新規投稿
</a>
```

### バリデーション
最後にバリデーションを行います。  
バリデーションとは **ユーザーが入力した内容が適切か検証を行うこと** です。   
不適切な場合は、必要に応じて警告などを表示します。  

不適切な場合とは例えば、  
- 必須入力欄なのに、空欄
- パスワードが短い
- 年齢を入れる欄に文字が入っている
などです。

皆さんも一度はログインやアカウント登録で、  
エラーが表示されたことがあるのではないでしょうか。  
不適切な値が入力された場合は、ユーザーが適切な値を入力できるように警告などを表示します。

現在文字を何も入力せずに投稿ボタンを押すと、エラーが表示されるかと思います。  
これはDBでは日記のタイトルなどが空になることを許可してないのに、  
空で保存しようとしているためです。  

#### 設定するバリデーション
日記はタイトルも本文も必ず入力してもらいたいので、  
入力を必須とします。

バリデーションをする方法はいくつかありますが、  
ここではそのうちの1つを紹介します。  

大まかな流れとしては以下の通りです。
1. バリデーションを記述するファイルを作成
2. 1にバリデーションの条件を記述
3. 1で作成したファイルを対象のメソッドで使用する
4. 画面に警告を表示する
5. 画面のinput欄に入力内容を保持する

#### 参考リンク
[バリデーション](https://readouble.com/laravel/6.x/ja/validation.html)

#### バリデーションを記述するファイルを作成

以下のコマンドを実行するだけです。  
`php artisan make:request DiaryRequest`

`app/Http/Requests`に`DiaryRequest`というファイルが作成されます。  


#### バリデーションの条件を記述

ファイルを以下のように修正します。  
```php
// app/Http/Requests/DiaryRequest

class DiaryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // falseから変更
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:30', 
            'body' => 'required',
        ];
    }
}
```

`rules()`メソッドにバリデーションのルールを記述します。  
今回は、フォームのname属性が`title`の場合は、  
入力必須(`required`)と、最大30文字(`max:30`)を設定してます。 


#### バリデーションのファイルを対象のメソッドで使用

```php
// app/Http/Controllers/DiaryController

use App\Http\Requests\DiaryRequest; // 追加

class DiaryController extends Controller
{
        // 中略

public function store(DiaryRequest $request) //変更
```

文字を何も入力しないで投稿ボタンを押すと元の画面にもどります。  
これはstoreメソッドを実行する前に、 `DiaryRequestクラス` に記述したバリデーションを実行しているためです。  

これでバリデーションはできるようになりましたが、  
画面に何も表示されないため、ユーザーには何がおこったかわからず不親切です。  

ユーザーにわかりやすいように画面にエラー内容を表示しましょう。  

#### 画面に警告を表示する

以下のように `@error` から `enderror` までを追記してください。
```php
// resources/views/diaries/create.blade.php

// 中略
<input type="text" class="form-control" name="title" id="title" />
 @error('title')
     <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
     </span>
 @enderror

// 中略
<textarea class="form-control" name="body" id="body"></textarea>
@error('body')
  <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
  </span>
@enderror
```

文字を何も入力せず、投稿ボタンを押してみましょう。  
文字を入力するように促すメッセージが表示されます。  
`@error` の `()` にはname属性が入ります。

#### 画面のinput欄に入力内容を保持する
エラーで元の画面に戻った後に、入力内容を1から入力し直すのは面倒です。  
そのため、入力内容を保持できるようにします。
値の保持は `inputタグ` の `value` に `old(name属性)` と入力するだけです。  
※ `textarea` の場合は、開始タグと終了タグの間

```php
// resources/views/diaries/create.blade.php

<input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">

<textarea class="form-control" name="body" id="body">{{ old('body') }}</textarea>
```

どちらか片方だけ入力して投稿ボタンをクリックして、  
投稿画面に戻った際に、投稿内容が保持されていればOKです。

### まとめ
これで新規投稿機能の作成は完了です。
このカリキュラムでは、以下の4つを学びました。  
1. ブラウザからURLを入力して、画面が表示されるまでの流れ(復習)
2. フォームからデータを送信する方法
3. データを保存する方法
4. バリデーションの方法

新しい内容が非常に多かったと思いますが、暗記する必要はありません。
**大まかにこういうことができる**ということ だけ覚えておけば、  
細かい書き方は、実際に書くときに調べれば問題ありません。