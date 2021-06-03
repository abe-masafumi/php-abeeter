<?php  

function h($str){
  return htmlspecialchars($str, ENT_QUOTES, 'utf-8');
}

// サーバー側のキーを作成
// (この時点で_COOKIEとsession_idが発行される、されただけ)
session_start();

// var_dump($_COOKIE["PHPSESSID"]);
// var_dump($_COOKIE);
var_dump(session_id());

var_dump($_SESSION);

// ログイン済みの処理
if (isset($_SESSION['EMAIL'])) {
  echo 'ようこそ' . h($_SESSION['EMAIL']) . "さん<br>";
  exit;
} else {
  echo '初めまして';
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>abeck</title>

</head>
<body>
  <!-- <form action="user.php" method="post">
    <div>
      <h1>ログイン</h1>
      <p>my name<input type="text" name="name"></p>
      <p>email<input type="email" name="email"></p>
      <input type="submit" value="送信">
    </div>
  </form> -->

    <h1>ようこそ、ログインしてください。</h1>
    <form  action="login.php" method="post">
      <label for="email">email</label>
      <input type="email" name="email">
      <label for="password">password</label>
      <input type="password" name="password">
      <button type="submit">Sign In!</button>
    </form>
    
    <h1>初めての方はこちら</h1>
    <form action="signUp.php" method="post">

      <label for="">name</label>
      <input type="text" name="user_name">

      <label for="email">email</label>
      <input type="email" name="email">

      <label for="sex">性別 男性</label>
      <input type="radio" name="sex" value="1">
      <label for="sex">女性</label>
      <input type="radio" name="sex" value="0">

      <label for="password">password</label>
      <input type="password" name="password">

      <button type="submit">Sign Up!</button>
      <p>※パスワードは半角英数字をそれぞれ１文字以上含んだ、８文字以上で設定してください。</p>
    </form>



</body>
</html>