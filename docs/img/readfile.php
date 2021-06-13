<?php 
session_start();
$id = $_SESSION['ID'];
require_once('../config.php');
$stmt = $pdo->prepare('SELECT * FROM signUp_table WHERE id = :id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$rows = $stmt->fetch(PDO::FETCH_ASSOC);

// var_dump($rows);
// exit(); 
// $img = base64_encode($rows['u_img']);

$DB_PIC = $rows['u_img'];
// var_dump($DB_PIC);

$finfo    = finfo_open(FILEINFO_MIME_TYPE);
$mimeType = finfo_buffer($finfo, $DB_PIC);
finfo_close($finfo);
// var_dump($mimeType);

header('Content-Type: ' . $mimeType);
// header("Content-type: image/gif");
// readfile("/path/to/foo.gif");
// exit;
echo $DB_PIC;

?>