<?php

ini_set('display_errors', 1);
// 「dbname」「port」「host」「username」「password」を設定
// DB接続情報　　　　↓ここだけ自分のデータベース名に変更！
define('DSN', 'mysql:host=localhost;dbname=gsacf_l05_01');
define('DB_USER', 'root');
define('DB_PASS', '');

try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit(); // 「dbError:...」が表示されたらdb接続でエラーが発生していることがわかる
}
?>