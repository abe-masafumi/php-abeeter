<?php
// var_dump($_GET);
// exit();

$id = $_GET['id'];
// ファイル読み込み
require_once('./config.php');
// 関数呼び出し


// idを指定して更新するSQLを作成(UPDATE文)論理削除
try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
  $stmt = $pdo->prepare('UPDATE abeeter_table SET deleted=1 WHERE id=:id');
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}

if ($status==false) {
  $error = $stmt->errorInfo();//errorInfo()後で調べる
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  header('Location:abeet.php');
}