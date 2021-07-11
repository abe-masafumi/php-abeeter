<?php  
require_once('config/config.php');
require_once('config/functions.php');
require_once('config/link.php');
// require_once('./config/functions.php');
// サーバー側のキーを作成
// (この時点で_COOKIEとsession_idが発行される、されただけ);
session_start();

// var_dump($_COOKIE["PHPSESSID"]);
// var_dump($_COOKIE);
// var_dump(session_id());
// var_dump($_SESSION);
// ログイン済みの処理
if (isset($_SESSION['EMAIL'])) {
  header("Location: $re_abeet");
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
        <img src="./img/abetter_rogo.png" alt="表示できません" class="illule">
        <h2>ようこそ、ログインしてください。</h2>
        <form  action="<?= $re_login ?>" method="post" class="box_1" autocomplete="off">
          <dl>
            <div class="email_form">
              <dt><label for="email">email</label></dt>
              <dd><input type="email" name="email" placeholder="email"></dd>
            </div>
            <div class="password_form">
              <dt><label for="password">password</label></dt>
              <dd><input type="password" name="password" placeholder="password"></dd>
            </div>
            <button type="submit" class="btn">ログイン</button>
          </dl>
        </form>
      </div>
      
      <h2>初めての方は<span id="open" onclick="form2.classList.contains('none')? form2.classList.remove('none') : form2.classList.add('none');">こちら</span></h2>
      <!-- autocomplete="off"予測変換無効 -->
      <div class="none" id="form2">
        <form action="<?= $re_signUp ?>" method="post" autocomplete="off">
          <dl class="signup_form">
            <div class="user_name_form">
              <dt><label for="user_name">name</label></dt>
              <dd><input type="text" name="user_name" placeholder="name"></dd>
            </div>
            <div class="email_form">
              <dt><label for="email">email</label></dt>
              <dd><input type="email" name="email" placeholder="email"></dd>
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
              <dd><input type="password" name="password" placeholder="password"></dd>
            </div>
            <button type="submit" class="btn">Sign Up!</button>
          </dl>
          <p>※パスワードは半角英数字をそれぞれ１文字以上含んだ、８文字以上で設定してください。</p>
        </form>
      </div>
    </div>
    <script>
      const form2 = document.getElementById('form2');
    </script>
</body>
</html>