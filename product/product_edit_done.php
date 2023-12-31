<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION["login"]) === false) {
    print "　ログインしていません。<br><br>";
    print "　<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
    exit();
} else {
    print "　".$_SESSION["name"]."さんログイン中";
    print "<br><br>";
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>商品修正実行</title>
<link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Sawarabi+Mincho&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
      crossorigin="anonymous"
    />
<link rel="stylesheet" href="../style.css">
</head>
    
<body class="align-items-center py-4 bg-body-tertiary">
    
<?php
    try{
    
require_once("../common/common.php");
    
$post = sanitize($_POST);
$code = $post["code"];
$name = $post["name"];
$price = $post["price"];
$image = $post["image"];
$old_image = $post["old_image"];
$comments = $post["explanation"];
$cate = $post["cate"];
        
if(empty($image) && isset($old_image) === true) {
    $image = $old_image;
}
if($old_image != "") {if($image != $old_image) {unlink("./image/".$old_image);}}  

$dsn = "mysql:host=localhost;dbname=shop_budo;charset=utf8";
$user = "root";
$password = "";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
$sql = "UPDATE mst_product SET category=?, name=?, price=?, image=?, explanation=? WHERE code=?";
$stmt = $dbh -> prepare($sql);
$data[] = $cate;
$data[] = $name;
$data[] = $price;
$data[] = $image;
$data[] = $comments;
$data[] = $code;
$stmt -> execute($data);
    
$dbh = null;
        
  
}
catch(Exception $e) {
    print "只今障害が発生しております。<br><br>";
    print "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
}
?>
    
<h1 class="h3 mb-3 fw-normal">商品を修正しました。</h1><br><br>

<p class="center"><a href="product_list.php">商品管理へ</a></p>

<br><br>
<footer>
    <p class="mt-5 mb-3 text-body-secondary">©Shop武道 2023</p>
</footer>

</body>
</html>