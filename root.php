<?php

// session_start();
require_once('./config.php');

try {
$pdo = new PDO(DSN, DB_USER, DB_PASS);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit(); // 「dbError:...」が表示されたらdb接続でエラーが発生していることがわかる
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$user_name = $_POST['user_name'];
$keyword = $_POST['keyword'];

    // var_dump($_POST);
    try {
      if(!is_null($user_name)){
        $sql = "SELECT * FROM abeeter_table where 1 ";
        $data=[];
        if($user_name   !==""    ){ $sql.= "AND user_name = ? ";            $data[]=$user_name;}
        // if($keyword     !==""    ){ $sql.= "AND abeet LIKE '%' || {$keyword} || '%'";}
        // SQLの実行はこう

        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        $all_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($all_rows);
        }
    } catch (PDOException $e) {
      echo json_encode(["db execute" => "{$e->getMessage()}"]);
      exit();
    }

    $output = '';

  foreach ($all_rows as $rows) {
    $output .= "<div class='flex'>
    <div class='margin'>{$rows['abeet'] }</div>
    <div>{$rows['post_time']}</div>
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
  <form action="" method="post">
  user_name: <input type="text" name="user_name">
  keyword: <input type="text" name="keyword">
    <input type="submit">
  </form>
<div>
<?php if ($_SERVER["REQUEST_METHOD"] == "POST") { echo $output;} ?>
</div>
</body>

</html>