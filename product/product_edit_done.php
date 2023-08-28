<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION["login"]) === false) {
    print "ログインしていません。<br><br>";
    print "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
    exit();
} else {
    print $_SESSION["name"]."さんログイン中";
    print "<br><br>";
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>商品修正実効</title>
<link rel="stylesheet" href="../style.css">
</head>
    
<body>
    
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
    
商品を修正しました。<br><br>
<a href="product_list.php">商品一覧へ</a>

</body>
</html>