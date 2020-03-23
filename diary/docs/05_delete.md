# 削除機能作成

## ルーティング
今まで同様ルートの設定を行います。  

```php
// routes/web.php

Route::delete('diaries/{diary}', 'DiaryController@destroy')->name('diary.destroy');
```

1箇所今までと異なる部分があります。  
`diary/{diary}` の`{diary}`には任意の値が入ります。  
今回削除機能で想定しているのは、diariesテーブルのidです。  
削除する場合は、削除するレコードを特定する必要があるため、各レコードのidをURLに組み込みます。 
この削除対象のレコードのidを `{diary}` の部分にいれるようにします。  

### 一覧画面に削除ボタンを追加
削除ボタンの作成方法は投稿ボタンとほとんど同じですが、  
2点異なる箇所があります。  
1. フォームのメソッドの指定方法
2. routeに第2引数がある

#### フォームのメソッドの指定方法
HTMLの仕様上GETとPOST以外のメソッドを使用できないため、  
フォームのmethodはPOSTにして、実際使用したいメソッドは、  
`@method('delete')`といった形でフォームの中に書きます。  

```php
// resources/views/diaries/index.blade.php

<p>{{ $diary->created_at }}</p>
<form action="{{ route('diary.destroy', ['diary' => $diary->id]) }}" method="POST" class="d-inline">
    @csrf
    @method('delete')
    <button class="btn btn-danger">削除</button>
</form>
```

### routeに第2引数がある
ルートで{diary}といった形で、  
任意の値を受け取る場合、画面でURLを作成する時は、  
`{{ route('diary.destroy', ['diary' => $diary->id]) }}` のように、  
`routeメソッド` の第2引数を連想配列で記述します。  
生成されるURLはdeveloper toolで確認してみましょう。  

一覧画面の削除ボタンをクリックして、  
以下のエラーが表示されればOKです。  
```
Method App\Http\Controllers\DiaryController::destroy does not exist.
```

## コントローラー
削除処理を行うメソッドを追加します。  

```php
public function destroy(Diary $diary)
{
    dd('ここで削除処理');
}
```


## モデル
テーブルのデータを削除するため、  
コントローラーからモデルに削除を依頼します。 

変数 `$diary` には Diaryクラスのインスタンスが格納されています。  

Laravelの機能として、  
web.phpのルートの定義で、`{diary}`の部分と、対応するControllerのメソッドの仮引数名`($diary)`が同じで、引数が型指定`Diary`となっていた場合、**自動的に該当するモデルのインスタンスを作成します。**  
インスタンスを作成できない場合(該当のidがない場合)は404を返してくれます。  
このように実装することで **エラーハンドリング** もまとめてできています。  

この仕組のことを **ルートモデルバインディング** といいます。  
### 参考リンク
[ルートモデルバインディング](https://laravel.com/docs/6.x/routing#route-model-binding)

```php
public function destroy(Diary $diary)
{
    $diary->delete();
}
```


## ビュー
一覧画面に戻るだけなので新たなビューの作成はありません。  
以下の通りリダイレクトの処理を追記するだけです。  

```php
public function destroy(Diary $diary)
{
    $diary->delete();

    return redirect()->route('diary.index');
}
```

ここまでかけたら、削除ボタンを押した際に押した際に、  
正しくデータが削除されることを確認してみましょう。  

また、developer toolで削除ボタンが押された際に実行されるURLの、  
diariesテーブルのIDが入ってる部分を存在しないIDに修正したあと削除ボタンを押してみましょう。  
404のエラーが返ってくることが確認できます。  

## まとめ
これで削除機能の作成は完了です。  

このカリキュラムでは、以下のことを学びました。  
1. ブラウザからURLを入力して、画面が表示されるまでの流れ(復習)
2. データを削除する方法