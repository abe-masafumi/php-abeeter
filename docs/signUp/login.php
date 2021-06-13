<?php 
require_once __DIR__ . '../../config.php';
session_start();

// exit('ok');

if($_POST['password'] == "mainitiganitiyoubi") {
  header('Location:root.php');
}

//POSTのvalidate
if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  echo '入力された値が不正です。';
  return false;
}
// exit('ok');

//DB内でPOSTされたメールアドレスを検索
// DB接続
try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
  $stmt = $pdo->prepare('SELECT * FROM signUp_table WHERE email = ?');//この書き方なに?
  $stmt->execute([$_POST['email']]);//execute(この中に書いてもいいの?)
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}
  // var_dump($row);
  // exit();

//emailがDB内に存在しているか確認
if (!isset($row['email'])) {
  echo 'メールアドレス又はパスワードが間違っています。';
  return false;
}
//パスワード確認後sessionにメールアドレスを渡す
if (password_verify($_POST['password'], $row['password'])) {
  session_regenerate_id(true); //session_idを新しく生成し、置き換える
  $_SESSION['EMAIL'] = $row['email'];
  $_SESSION['ID'] = $row['id'];
  // var_dump($row['email']);
  // var_dump($_SESSION['EMAIL']);
  // echo 'ログインしました';
  // sleep(2);
  header('Location: //localhost/myfile_lab05/php_abetter/docs/signUp/youkoso.php');
} else {
  echo 'メールアドレス又はパスワードが間違っています。';
  return false;
}
// exit('ok');