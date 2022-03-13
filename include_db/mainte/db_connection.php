<?php 
require('db_info.php');
// DB接続時の例外処理
try {
  // global $pdo;
  $pdo = new PDO(DB_HOST, DB_USER, DB_PASSWORD, [PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES=>false]);
} catch (PDOexception $e) {
  echo '接続失敗' . $e->getMessage(). '\n';
  exit();
}