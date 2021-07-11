<?php

require_once('config/config.php');
require_once('config/functions.php');
require_once('config/link.php');

// var_dump($_FILES);
// exit();
session_start();

// $email = $_SESSION['EMAIL'];
// $up_image = $_FILES['file']['name'];
// var_dump($up_image);
// exit();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
     
      <form action="<?= $re_abeet ?>" enctype="multipart/form-data" method="post" autocomplete="off">
      <fieldset>
        <legend>DB連携型todoリスト（入力画面）</legend>
        <!-- <a href="">一覧画面</a> -->
        <label>画像を選択 <br>
        <input type="file" name="my_movie" accept="image/*">
        <input type="hidden" name="MAX_FILE_SIZE" value="4194304" />
        <div>
          abeet: <input type="text" name="abeet">
          <input type="hidden" name="u_img" value="">
        </div>
        <div>
          <button>submit</button>
        </div>
      </fieldset>
    </form>
</body>
</html>