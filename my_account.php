<?php
require_once('config/config.php');
require_once('config/functions.php');
require_once('config/link.php');
session_start();
$email = $_SESSION['EMAIL'];
// var_dump($_SESSION['EMAIL']);
// exit();
$stmt = $pdo->prepare('SELECT * FROM signUp_table WHERE email = :email');
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$rows = $stmt->fetch(PDO::FETCH_ASSOC);




?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/my_account.css">

</head>
<body>
  <header>
  <div class="top_menu">
    <div><a href="<?= $re_abeet ?>"><-</a></div>
    <div>プロフィール</div>
    <div id="fix"><a href="my_profile_fix.php">プロフィール編集</a></div>
  </div>
  <div class="container1">
    <a href="pic.php"><div id="my_img"><img src="<?= $rows['u_img_name'] == NULL ? './img/鬼です！！！！！2.jpg' : './img/readfile.php'; ?>"></div></a>
    <div class="user_name"><div><?= $rows['user_name'] ?></div></div>
  </div>
  <div class="container2">
    <div><?= $rows['my_profile'] ?></div>
  </div>
<div class="menu">
  <ul>
    <li>リスト1</li>
    <li>リスト2</li>
    <li>リスト3</li>
    <li>リスト4</li>
    <li>リスト5</li>
    <li>リスト6</li>
  </ul>
</div>

  </header>
</body>
</html>