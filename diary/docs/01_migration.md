# DBへテーブルの作成
Laravelにはテーブル作成をサポートする機能がついています。  

## マイグレーション
マイグレーションとは、簡単にいうと、  
テーブルの作成やカラムの追加など、  
DBへのテーブル追加や、変更を簡単に行える機能です。  

DBへのテーブルの作成は、以下の手順で行います。  
1. マイグレーションファイルの作成
2. マイグレーションファイルの編集
3. マイグレーションの実行  

マイグレーションファイルとは `テーブルの設計図` のようなものです。  
1, 2で設計図を作成、3で設計図をもとにテーブルを作成しています。  

この機能を使用することで、  
自分でSQLを書くことなく、テーブルの作成が行えます。  
また、例えば新たに開発メンバーが加わった場合も、  
マイグレーションファイルを使用することで簡単に同じDBの環境を準備できます。  

### マイグレーションファイルの作成
では実際にマイグレーションを行います。  
まずはマイグレーションファイルの作成ですが、  
これもコマンド1つで行えます。  

以下のコマンドを実行することで、  
`php artisan make:migration create_diaries_table`  

`database`ディレクトリに`yyyy_mm_dd_hhmmii_create_diaries_table.php`というファイルが作成されます。  

今回は、diariesテーブルを作成するファイルのため、  
`create_diaries_table`となっています。  

### マイグレーションファイルの編集
次に作成したファイルを編集します。  
今回のようにテーブルの作成の場合は、  
作成するカラム名などを入力します。  

```php
// database/yyyy_mm_dd_hhmmii_create_diaries_table.php

public function up()
{
    Schema::create('diaries', function (Blueprint $table) {
        $table->increments('id'); 
        $table->string('title', 30); //追加
        $table->text('body'); //追加
        $table->timestamps();
    });
}
```

### 実行
最後に編集したマイグレーションの実行ですが、これもコマンド1つです。
`php artisan migrate`

上記コマンドを実行することで、ファイルに入力した内容(今回はテーブルの作成)が実行されます。  
DBを確認してテーブルが作成されているか確認してみましょう。

### 参考リンク
[マイグレーション](https://readouble.com/laravel/6.x/ja/migrations.html)