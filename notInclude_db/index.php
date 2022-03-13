<?php
require('model/db_connection.php');

// アップロード成功のフラグをまずFALSEにいしておく。
$result_flag = false;

// POST通信されていることと、それが空でないことの確認
// ※$_FILESはinputである以上必ず渡ってくるので、nameプロパティに文字列が入っているかどうかで判別
if (isset($_POST) && !empty($_FILES['image']['name'])) {
  // アップロードされたファイル名の取得
  $filename = $_FILES['image']['name'];

  /*  
  *   アップロードされたファイルはサーバの一時的な格納場所（テンポラリ）に格納されている。その場*   所が$_FILES[name属性]['tmp_name']
  *   ↑ 一時的に格納されている場所から任意の場所に移動させる処理を行う。
  *   そのための関数がmove_uploaded_file(旧,新); 戻り値はboolean
  */

  // move_uploaded_file()の引数ように格納先のパスを変数へ代入。
  $upload_path = './images/' . $filename;  //相対パス

  // ファイル移動を実行。move_uploaded_fileの結果(フラグ)を受け取る
  $result_flag = move_uploaded_file($_FILES['image']['tmp_name'], $upload_path);

  // 処理結果を表示
  if ($result_flag) {
    echo 'アップロードに成功しました。';
  } else {
    echo 'アップロードに失敗しました。';
  }
} else {
  echo '画像をアップロードしてください';
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>画像アップロードサンプル</title>
</head>

<body>
  <form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="image" id="" required><br>
    <input type="submit" value="upload">
  </form>
  <!-- アップロードされた画像のプレビュー -->
  <?php if ($result_flag) : ?>
    <img src="<?= $upload_path ?>" alt="">
  <?php endif; ?>
</body>

</html>