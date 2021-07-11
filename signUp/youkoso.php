<?php 
require_once('../config/link.php');
require_once('../config/functions.php');
require_once('../config/config.php');
session_start();
// var_dump($_SESSION['EMAIL']);
// exit();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    body {
      background: rgb(17, 82, 105);
      color: white;
    }

    .x {
      margin: auto;
      width: 800px;
    }

    img,
    p {
      font-size: 50px;
      text-align: center;
      opacity: 0.1;
      animation: wowwow 5s ease-in alternate;
    }

    @keyframes wowwow {
      0% {
        opacity: 0;
      }

      30% {
        opacity: 0.6;
      }

      60% {
        opacity: 1;
      }

      100% {
        opacity: 1;
      }
    }
  </style>
</head>

<body>
  <div class="x">
    <img src="../img/abetter_rogo.png" alt="表示されませんでした" class="x">
    <p>ようこそ<?=  $_SESSION['EMAIL']  ?>さん</p>
  </div>

</body>

<script>
  setTimeout(function () {
    window.location.href = 'https://localhost/myfile_lab05/php_abetter/abeet/abeet.php';
  }, 4000);

</script>

</html>