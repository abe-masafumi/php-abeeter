<?php

// session_start();
require_once('config/config.php');
require_once('config/functions.php');
require_once('config/link.php');

try {
$pdo = new PDO(DSN, DB_USER, DB_PASS);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit(); // 「dbError:...」が表示されたらdb接続でエラーが発生していることがわかる
}

// DB接続
try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
  // データベースから$_SESSION['EMAIL']を探して行ごと取得
  $stmt = $pdo->prepare('SELECT * FROM signUp_table');
  $stmt->execute();
  $all_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  // var_dump($all_rows);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}
$option = "<option></option>";
foreach ($all_rows as $rows) {
  $option .= "<option>{$rows['user_name']}</option>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$user_name = $_POST['user_name'];
$user_name2 = $_POST['user_name2'];
$sex = $_POST['sex'];
$keyword = $_POST['keyword'];
$key_word = "%".$keyword."%";
    // var_dump($keyword);
    // exit('ok');
    try {
      if(!is_null($user_name)){
        $sql = "SELECT * FROM abeeter_table where 1 ";
        $data=[];
        if($user_name   !==""    ){ $sql.= "AND user_name = ? ";                $data[]=$user_name;}
        if($user_name2   !==""    ){ $sql.= "AND user_name = ? ";                $data[]=$user_name2;}
        if($sex         !==""    ){ $sql.= "AND sex = ? ";                      $data[]=$sex;}
        // if($keyword     !==""    ){ $sql.= "AND abeet LIKE keyword = :keyword"; $data[]=$key_word;}
        // SQLの実行はこう

        $stmt = $pdo->prepare($sql);
        // $stmt->bindValue(':keyword', "%{$keyword}%", PDO::PARAM_STR);
        $stmt->execute($data);
        $all_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($all_rows);
        // exit('ok');
        }
    } catch (PDOException $e) {
      echo json_encode(["db execute" => "{$e->getMessage()}"]);
      exit();
    }

    $output = '';

  foreach ($all_rows as $rows) {
    $output .= "<div class='flex'>
    <div class='margin'>{$rows['user_name'] }</div>
    <div class='margin'>{$rows['abeet'] }</div>
    </div>";
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
  <style>
    .flex {
      display: flex;
    }
    .margin {
      margin-right: 20px;
    }
  </style>
</head>

<body>
  <form action="" method="post" autocomplete="off">
  user_name: <input type="text" name="user_name">
  user_name2: <select name="user_name2">
<?= $option; ?>
  </select>
  keyword: <input type="text" name="keyword">
  sex: <input type="text" name="sex">
    <input type="submit">
  </form>
<div>
<?php if ($_SERVER["REQUEST_METHOD"] == "POST") { echo $output;} ?>
</div>
</body>

</html>