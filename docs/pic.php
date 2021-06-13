<?php
session_start();
require_once('./config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // ------画像アップロード--------
  // var_dump($_FILES);
  $up_image = $_FILES['file']['name']; //画像名
// var_dump($up_image);
// exit();
// //アップロード処理 imgフォルダの読み書き権限を確認すること！
$upload = "./img/";
if (move_uploaded_file($_FILES['file']['tmp_name'], $new_file = $upload . $up_image)) {
    echo 'アップロード成功';
    // exit();
} else {
    echo 'アップロード失敗';
    // exit();
}

$stmt = $pdo->prepare('UPDATE abeeter_table SET u_img_name=:u_img_name WHERE email = :email');
$stmt->bindValue(':email', $_SESSION['EMAIL']);
$stmt->bindValue(':u_img_name', $up_image);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  exit('sqlError:' . $error[2]);
}


  // ------画像アップロード--end------

  if ($_FILES['file']) {
    $id = $_SESSION['ID'];
  }

  $fp = fopen($new_file, "rb");
  $img = fread($fp, filesize($new_file));
  fclose($fp);
  // var_dump($img);
  // exit();
  $stmt = $pdo->prepare('UPDATE signUp_table SET u_img=:u_img, u_img_name=:u_img_name WHERE id = :id');
  $stmt->bindValue(':id', $id);
  $stmt->bindValue(':u_img', $img);
  $stmt->bindValue(':u_img_name', $up_image);
  $status = $stmt->execute();

  // $stmt1 = $pdo->prepare('UPDATE abeeter_table SET u_img_name=:u_img_name WHERE id = :id');
  // $stmt1->bindValue(':id', $id);
  // $stmt1->bindValue(':u_img_name', $up_image);
  // $status1 = $stmt1->execute();

  // $all_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if ($status == false) {
    $error = $stmt->errorInfo();
    // データ登録失敗次にエラーを表示 
    exit('sqlError:' . $error[2]);
  } else {
    // 登録ページへ移動
    header('Location: ./my_account.php');
    // echo '投稿できました！';
  }
}
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
  <form action="" enctype="multipart/form-data" method="post">
    <label>画像を選択 <br>
      <input type="file" name="file" accept="image/*">
      <input type="hidden" name="id" value="<?= $_SESSION['ID'] ?>">
      <input type="hidden" name="MAX_FILE_SIZE" value="4194304" />

    </label>
    <input type="submit">
  </form>
</body>

</html>