<?php
require_once('config/config.php');
require_once('config/functions.php');
require_once('config/link.php');
session_start();
$email = $_SESSION['EMAIL'];

$stmt = $pdo->prepare('SELECT * FROM signUp_table WHERE email = :email');
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$rows = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $my_profile = $_POST['profile'];

  $stmt = $pdo->prepare('UPDATE signUp_table SET my_profile=:my_profile WHERE email=:email');
  $stmt->bindValue(':my_profile', $my_profile, PDO::PARAM_STR);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $status = $stmt->execute();

  if ($status == false) {
    $error = $stmt->errorInfo(); //errorInfo()後で調べる
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
  } else {
    header("Location: $re_my_account");
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
  <form action="" method="post">
    <textarea name="profile" id="" cols="30" rows="10"><?= $rows['my_profile'] ?></textarea>
    <input type="submit">
  </form>
</body>

</html>