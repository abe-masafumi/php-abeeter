<?php
var_dump($_POST);
// exit();

if ( // 入力チェック(未入力の場合は弾く，commentのみ任意)
  !isset($_POST['abeet']) || $_POST['abeet'] == ''
) {
  exit('Param Error');
} // 解説

$abeet = $_POST['abeet'];
$id = $_POST['id'];

require_once('./config.php');

  $stmt = $pdo->prepare('UPDATE abeeter_table SET abeet=:abeet WHERE id=:id');
  $stmt->bindValue(':abeet', $abeet, PDO::PARAM_STR);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $status = $stmt->execute();

if ($status==false) {
  $error = $stmt->errorInfo();//errorInfo()後で調べる
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  header('Location:abeet.php');
}

// idを指定して更新するSQLを作成(UPDATE文)
// $sql = "UPDATE todo_table SET todo=:todo, deadline=:deadline,
// updated_at=sysdate() WHERE id=:id";
// $stmt = $pdo->prepare($sql);
// $stmt->bindValue(':todo', $todo, PDO::PARAM_STR);
// $stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
// $stmt->bindValue(':id', $id, PDO::PARAM_INT);
// $status = $stmt->execute();

?>