<?php

require_once('./config.php');

$id = $_GET['id'];

try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
  $stmt = $pdo->prepare('SELECT * FROM abeeter_table WHERE id=:id');
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}

if ($status == false) {
  $error = $stmt->errorInfo(); //errorInfo()後で調べる
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  $record = $stmt->fetch(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOCここの種類調べる
}


?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（編集画面）</title>
  <link rel="stylesheet" href="css/abeet.css">
  <style>
    input {
      width: 100%;
    }
  </style>
</head>

<body>
  <form action="abeet_Update.php" method="post">
    <fieldset>
      <legend>DB連携型todoリスト（編集画面）</legend>
      <!-- <a href="">一覧画面</a> -->
      <div>
        abeet: <textarea name="abeet" cols="40" rows="5" class="inputText"><?= $record['abeet']; ?></textarea>
        <input type="hidden" name="id" value="<?= $record['id']; ?>">

      </div>
      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>
</body>

</html>