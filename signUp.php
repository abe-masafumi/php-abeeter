<?php
if (
  !isset($_POST['user_name']) || $_POST['user_name'] == '' ||
  !isset($_POST['email']) || $_POST['email'] == '' ||
  !isset($_POST['sex']) || $_POST['sex'] == '' ||
  !isset($_POST['password']) || $_POST['password'] == ''
) {
  exit('Param Error');
} // 解説
// 「ParamError」が表示されたら，必須データが送られていないことがわかる
// exit('ok');


require_once('config.php');
//データベースへ接続
// DB接続
try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit(); // 「dbError:...」が表示されたらdb接続でエラーが発生していることがわかる
}


if (strlen($_POST['user_name']) > 10) {
  echo '名前が多いっす';
  return false;
} else {
  $user_name = $_POST['user_name'];
}
var_dump($user_name);


// メールアドレスが正しいか微妙にチェック
if (!$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  echo '入力された値が不正っす';
  return false;
}
var_dump($email);


$sex = $_POST['sex'];


var_dump($sex);

//パスワードの正規表現
if (preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $_POST['password'])) {
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
} else {
  echo 'パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してくださいっす。';
  return false;
}
var_dump($password);



//登録処理
try {
  $stmt = $pdo->prepare("INSERT INTO signUp_table(id, user_name, email, sex, password,	signUp_date) VALUE(NULL, :user_name, :email, :sex , :password, sysdate())");
  // $stmt->execute([$user_name, $email, $sex, $password]);
  $stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->bindValue(':sex', $sex, PDO::PARAM_INT);
  $stmt->bindValue(':password', $password, PDO::PARAM_STR);
  $status = $stmt->execute(); // SQLを実行
  // var_dump($status);
  echo '登録完了';
  // header('Location:index.php');
} catch (\Exception $e) {
  echo '登録済み もしくはサーバーに書き込めなかった！';
}
