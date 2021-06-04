<?php  

function h($str){
  return htmlspecialchars($str, ENT_QUOTES, 'utf-8');
}

// サーバー側のキーを作成
// (この時点で_COOKIEとsession_idが発行される、されただけ)
session_start();

// var_dump($_COOKIE["PHPSESSID"]);
// var_dump($_COOKIE);
// var_dump(session_id());

// var_dump($_SESSION);

// ログイン済みの処理
if (isset($_SESSION['EMAIL'])) {
  echo 'ようこそ' . h($_SESSION['EMAIL']) . "さん<br>";
  // sleep(3);
  header('Location: abeet.php');
  exit;
} else {
  echo '';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>abeck</title>
  <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="container">
      <div class="rogin_form">
        <h2>ようこそ、ログインしてください。</h2>
        <form  action="login.php" method="post" class="box_1">
          <dl>
            <div class="email_form">
              <dt><label for="email">email</label></dt>
              <dd><input type="email" name="email"></dd>
            </div>
            <div class="password_form">
              <dt><label for="password">password</label></dt>
              <dd><input type="password" name="password"></dd>
            </div>
            <button type="submit" class="btn">Sign In!</button>
          </dl>
        </form>
      </div>
      
      <h1>初めての方はこちら</h1>
      <form action="signUp.php" method="post">
        <dl class="signup_form">
          <div class="user_name_form">
            <dt><label for="user_name">name</label></dt>
            <dd><input type="text" name="user_name"></dd>
          </div>
          <div class="email_form">
            <dt><label for="email">email</label></dt>
            <dd><input type="email" name="email"></dd>
          </div>
          <div class="men_form">
            <dt><label for="sex">性別</label></dt>
            <dd><input type="radio" name="sex" value="1">男性</dd>
          </div>
            <div class="women_form">
              <dt><label for="sex"></label></dt>
              <dd><input type="radio" name="sex" value="0">女性</dd>
            </div>
          <div class="password_form">
            <dt><label for="password">password</label></dt>
            <dd><input type="password" name="password"></dd>
          </div>
          <button type="submit" class="btn">Sign Up!</button>
        </dl>
        <p>※パスワードは半角英数字をそれぞれ１文字以上含んだ、８文字以上で設定してください。</p>
      </form>
    </div>
</body>
</html>