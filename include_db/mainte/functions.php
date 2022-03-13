<?php
// $_FILES['image']を受け取ってDBに格納するFunction
function insert_image($request)
{
  // 画像をディレクトリに保存
  $upload_path ='./images/' . $request['name'];
  $is_success_move_uploaded =  move_uploaded_file($request['tmp_name'], $upload_path);

  // storage/imagesへの保存が成功していれば
  if ($is_success_move_uploaded) {
    // DBに画像の情報を格納
    global $pdo;
    $params = [
      'image_name' => $request['name'],
      'image_type' => $request['type'],
      'image_path' => $upload_path, //保存先パスを指定
      'image_size' => $request['size']
    ];
    // prepare用のinsert文を生成
    $columns = '';
    $values = '';
    $count = 0;
    foreach (array_keys($params) as $key) {
      if ($count > 0) {
        $columns .= ',';
        $values .= ',';
      }
      $columns .= $key;
      $values .= ':' . $key;
      $count++;
    }
    // DB格納の実行
    $sql = "INSERT INTO images({$columns}) VALUES ({$values})";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute($params);
    // 格納結果で条件分岐して成功なら保存先パス、失敗なら空Stringを返す
    if ($result) {
      return $upload_path;
    }
    return;
  }
}
