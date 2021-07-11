<?php
// exit('ok');
// これがないとセッションのデータを取れない
session_start();
$id = $_SESSION['ID'];

// ↑ここでログインで登録した$_SESSION['EMAIL']が取得できる
// var_dump($_SESSION);

if (isset($_COOKIE['PHPSESSID'])) {
  $myId = $_COOKIE['PHPSESSID'];
} else {
  $myId = '';
}



require_once('../config/link.php');
require_once('../config/functions.php');
require_once('../config/config.php');

$stmt = $pdo->prepare('SELECT * FROM abeeter_table WHERE deleted = 0 ORDER BY id desc');
$stmt->execute();
$all_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$output = '';
foreach ($all_rows as $rows) {
  $output .= "<div class='block'>
  <div class='my_thmbnail'>";
if ($rows['up_image'] != NULL) {
  $output .= "<img id='u_img' src='../post_img/{$rows['up_image']}' >";
} else {
  $output .= "<img src='../img/環境問題.jpeg' alt='画像がうまく表示されません'>";
};

  $output .="
  </div>
    <div class='my_info'>";
  if ($rows['u_img_name'] != NULL) {
    $output .= "<img id='u_img' src='../img/{$rows['u_img_name']}' >";
  } else {
    $output .= "<img id='u_img' src='../img/鬼です！！！！！2.jpg' >";
  }
  $output .= "
  <div id='u_name'>{$rows['user_name']}</div>
  </div>
    <div class='my_text'>{$rows['abeet']}</div>
    <div class='my_abeet' id='my_abeet'>
    <a href='abeet_edit.php?id={$rows["id"]}'>edit</a>
    <a href='abeet_delete.php?id={$rows["id"]}'>delete</a>
  </div>
  </div>";
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

  $abeet = $_POST['abeet'];
  $up_image = $_FILES['my_movie']['name'];
  // var_dump($up_image);
  // exit('ok');

  $upload = "../post_img/";
  if (move_uploaded_file($_FILES['my_movie']['tmp_name'], $new_file = $upload . $up_image)) {
    echo 'アップロード成功';
    // exit();
  } else {
    echo 'アップロード失敗';
    // exit();
  }

  // require_once('./config/config.php');

// exit('ok');
  // データベースから$_SESSION['EMAIL']を探して行ごと取得
  $stmt = $pdo->prepare('SELECT * FROM signUp_table WHERE email = ?');
  $stmt->execute([$_SESSION['EMAIL']]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($row);
  $user_name = $row['user_name'];
  $sex = $row['sex'];
  $password = $row['password'];
  $email = $row['email'];
  $u_img_name = $row['u_img_name'];
  // $up_image = $row['up_image'];
  // var_dump($up_image);

  // SQL作成&実行
  $sql = "INSERT INTO abeeter_table(id, user_name, abeet, sex, password, email, post_time, u_img_name, up_image) VALUES(NULL, :user_name, :abeet, $sex, :password, :email, sysdate(), :u_img_name, :up_image)";
  $stmt = $pdo->prepare($sql);
  // 変数をバインド変数(:todo)に格納!!
  $stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
  $stmt->bindValue(':abeet', $abeet, PDO::PARAM_STR);
  $stmt->bindValue(':password', $password, PDO::PARAM_STR);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->bindValue(':u_img_name', $u_img_name, PDO::PARAM_STR);
  $stmt->bindValue(':up_image', $up_image, PDO::PARAM_STR);
  $status = $stmt->execute(); // SQLを実行

  if ($status == false) {
    $error = $stmt->errorInfo();
    // データ登録失敗次にエラーを表示 
    exit('sqlError:' . $error[2]);
  } else {
    // 登録ページへ移動
    header("Location: $re_abeet");
    echo '投稿できました！';
  }
} //postされたらの終わり

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（入力画面）</title>
  <link rel="stylesheet" href="../css/abeet.css">
</head>

<body>
  <header>
    <div>
      <h3>投稿一覧</h3>
    </div>
    <div class="story">
      <ul>
        <li>1</li>
        <li>2</li>
        <li>3</li>
        <li>4</li>
      </ul>
    </div>
  </header>
  <main>
    <div> <a href="<?= $re_logout ?>">ログアウト</a></div>

    <!-- <form action="" method="post" autocomplete="off">
      <fieldset>
        <legend>DB連携型todoリスト（入力画面）</legend>
        <a href="">一覧画面</a>
        <div>
          abeet: <input type="text" name="abeet">
          <input type="hidden" name="u_img" value="">

        </div>
        <div>
          <button>submit</button>
        </div>
      </fieldset>
    </form> -->

    <!-- 大コンテナ -->
    <div>
      <!-- 小コンテナ -->
      <div class="small_container">
        <?= $output; ?>
      </div>
    </div>
  </main>
  <!-- メニュー一覧 -->
  <footer>
    <div class="menu_box">
      <ul>
        <li>
          <div></div>
        </li>
        <li>
          <div></div>
        </li>
        <li>
          <div><a href="//localhost/myfile_lab05/php_abetter/post.php">投稿</a></div>
        </li>
        <li>
          <div></div>
        </li>
        <li id="account">
          <div><a href="//localhost/myfile_lab05/php_abetter/my_account.php">アカウント</a></div>
        </li>
      </ul>
    </div>
  </footer>
  <script>
    const my_abeet = document.getElementById('my_abeet');
    // const account = document.getElementById('account');
    // account.addEventListener('click', () => {
    //   window.location.href = 'my_account.php';
    // });
  </script>

</body>

</html>