<?php
// これがないとセッションのデータを取れない
session_start();
// ↑ここでログインで登録した$_SESSION['EMAIL']が取得できる
// var_dump($_SESSION);

if (isset($_COOKIE['PHPSESSID'])) {
  $myId = $_COOKIE['PHPSESSID'];
} else {
  $myId = '';
}
// var_dump($myId);
// exit("0k");


require_once('./config.php');

// exit('ok');

// DB接続
try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
  // データベースから$_SESSION['EMAIL']を探して行ごと取得
  $stmt = $pdo->prepare('SELECT * FROM abeeter_table');
  $stmt->execute();
  $all_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}
// var_dump($all_rows);

$output = '';

foreach ($all_rows as $rows) {
  $output .= "<div class='block'>
  <div class='my_thumbnail'>{$rows['email']}</div>
  <div class='my_abeet'>
    <div class='my_name'>{$rows['user_name']}</div>
    <div class='my_text'>{$rows['abeet']}</div>
  </div>
  </div>"
  ;
}



// (追加)でpostされたかどうかのチェック
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if ( // 入力チェック(未入力の場合は弾く，commentのみ任意)
    !isset($_POST['abeet']) || $_POST['abeet'] == ''
  ) {
    exit('Param Error');
  } // 解説
  // 「ParamError」が表示されたら，必須データが送られていないことがわかる
  // 送られてきたデータを変数に格納
  // exit('ok');

  $abeet = $_POST['abeet'];
  // var_dump($abeet);

  // exit('ok');


  require_once('./config.php');

  // exit('ok');

  // DB接続
  try {
    $pdo = new PDO(DSN, DB_USER, DB_PASS);
    // データベースから$_SESSION['EMAIL']を探して行ごと取得
    $stmt = $pdo->prepare('SELECT * FROM signUp_table WHERE email = ?');
    $stmt->execute([$_SESSION['EMAIL']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
  }

  // これがユーザーデータ
  // var_dump($row);




  // exit('ok');

  // ↑のデータを下に↓に当てはめるところからーーーーーーーーーーーーーーーーーーーーーーー

  $user_name = $row['user_name'];
  $sex = $row['sex'];
  $password = $row['password'];
  $email = $row['email'];


  // var_dump($user_name);
  // var_dump($sex);
  // var_dump($password);
  // var_dump($email);



  // exit('ok2');

  // SQL作成&実行
  // $sql = "INSERT INTO abeeter_table(id, user_name, abeet, sex, password, email, post_time) VALUES(NULL, $user_name, :abeet, $sex, $password, 'hoge@ggg@.con', sysdate())";
  $sql = "INSERT INTO abeeter_table(id, user_name, abeet, sex, password, email, post_time) VALUES(NULL, :user_name, :abeet, $sex, :password, :email, sysdate())";


  $stmt = $pdo->prepare($sql);
  // 変数をバインド変数(:todo)に格納!!
  $stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
  $stmt->bindValue(':abeet', $abeet, PDO::PARAM_STR);
  $stmt->bindValue(':password', $password, PDO::PARAM_STR);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $status = $stmt->execute(); // SQLを実行


  if ($status == false) {
    $error = $stmt->errorInfo();
    // データ登録失敗次にエラーを表示 
    exit('sqlError:' . $error[2]);
  } else {
    // 登録ページへ移動
    header('Location:abeet.php');
    // echo '投稿できました！';
  }
}//postされたらの終わり





?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（入力画面）</title>
  <link rel="stylesheet" href="css/abeet.css">
</head>

<body>
  <div> <a href="logout.php">ログアウト</a> </div>
  <form action="" method="post">
    <fieldset>
      <legend>DB連携型todoリスト（入力画面）</legend>
      <!-- <a href="">一覧画面</a> -->
      <div>

        abeet: <input type="text" name="abeet">
 
      </div>
      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>
  <!-- 大コンテナ -->
  <div>
    <!-- 小コンテナ -->
    <div>
    <?= $output; ?>
    </div>
  </div>
              <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->

</body>

</html>