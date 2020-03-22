# テストデータの作成
次にテストデータの作成を行います。  
テーブルだけ作成してもデータがないと確認できない機能もあります。  
例えば、日記の一覧を表示する機能は、表示するための日記のデータが必要です。  

テストデータの作成手順は以下です。
1. テストデータ作成用ファイルを作成
2. テストデータ作成用ファイルを編集
3. テストデータ作成用ファイルの実行

テストデータ作成用ファイルとは `どんなテストデータを挿入するかを表したもの` です。  
1, 2でどんなデータを挿入するか記述し、3で実際にテーブルにデータを挿入します。  

### テストデータ作成用ファイルの作成
ファイルの作成は簡単です。
これもコマンド1つでできます。  

`php artisan make:seeder DiariesTableSeeder`  

上記コマンドを実行すると、`database/seeds`に`DiariesTableSeeder`というファイルが作成されます。  


### テストデータ作成用ファイルの編集

```php
// database/seeds/DiariesTableSeeder
 public function run()
 {
     $diaries = [
         [
             'title' => 'セブでプログラミング',
             'body'  => '気づけばもうすぐ2ヶ月',
         ],
         [
             'title' => '週末は旅行',
             'body'  => 'オスロブに行ってジンベエザメと泳ぎました',
         ],
         [
             'title' => '英語授業',
             'body'  => '楽しい',
         ],
     ];

     foreach ($diaries as $diary) {

         DB::table('diaries')->insert([
             'title' => $diary['title'],
             'body' => $diary['body'],
             'created_at' => Carbon\Carbon::now(),
             'updated_at' => Carbon\Carbon::now(),
         ]);
     }
 }
```

### テストデータ作成用ファイルの実行

これもコマンド1つで行えます。  
`php artisan db:seed`  

上記コマンドを実行すると 
`database/seeds/DatabaseSeeder` の `runメソッド` が実行されます。  
`runメソッド` に `DiariesTableSeederを実行する` 命令を記述する必要があります。  

`database/seeds/DatabaseSeeder` の `runメソッド` に以下をを追記しましょう。  

```php
$this->call(DiariesTableSeeder::class);
```

`php artisan db:seed` を実行して、diariesテーブルにデータが保存されていることを確認しましょう。

### 参考リンク
[シーディング](https://readouble.com/laravel/6.x/ja/seeding.html)