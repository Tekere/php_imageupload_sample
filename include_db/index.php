<?php
require('mainte/db_connection.php');
require('mainte/functions.php');

// アップロード成功時にパスが入る変数。予め空にしておく。
$uploaded_path = '';

// POST通信されていることと、それが空でないことの確認
// ※$_FILESはinputである以上必ず渡ってくるので、nameプロパティに文字列が入っているかどうかで判別
if (isset($_POST) && !empty($_FILES['image']['name'])) {
  // アップロードされたファイル名の取得
  $filename = $_FILES['image']['name'];
  /*  
  *   アップロードされたファイルはサーバの一時的な格納場所（テンポラリ）に格納されている。その場*   所が$_FILES[name属性]['tmp_name']
  *   ↑ 一時的に格納されている場所からDB格納の処理を行う。
  */

  // DB格納を実行。



  // 実行
  $uploaded_path = insert_image($_FILES['image']);
  // 処理結果を表示
  if ($uploaded_path) {
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
  <?php if (!empty($uploaded_path)) : ?>
    <img src="<?= $uploaded_path ?>" alt="">
  <?php endif; ?>
</body>

</html>