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
<title>商品情報修正</title>
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
    
$code = $_GET["code"];
    
$dsn = "mysql:host=localhost;dbname=shop_budo;charset=utf8";
$user = "root";
$password = "";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
$sql = "SELECT category, code, name, price, image, explanation FROM mst_product WHERE code=?";
$stmt = $dbh -> prepare($sql);
$data[] = $code;
$stmt -> execute($data);
    
$dbh = null;
    
$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
    
if(empty($rec["image"]) === true) {
    $detail_image = "";
} else {
    $detail_image = "<img src='./image/".$rec['image']."'>";
}
    
}
catch(Exception $e) {
    print "只今障害が発生しております。<br><br>";
    print "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
}
?>

<h1 class="h3 mb-3 fw-normal">商品情報修正</h1>
<div class="container text-center">
  <p class="product_edit_text">商品コード<?php print $rec["code"];?>の情報を修正します。</p>

<br>
<form action="product_edit_check.php" method="post" enctype="multipart/form-data">
<p class="product_edit_text">カテゴリー</p>
<?php require_once("../common/common.php");?>
<?php print pulldown_cate();?>
<br><br>
<p class="product_edit_text">商品名</p>
<input type="text" name="name" value="<?php print $rec['name'];?>">
<br><br>
<p class="product_edit_text">価格</p>
<input type="text" name="price" value="<?php print $rec['price'];?>">
<br><br>
<p class="product_edit_text">画像</p>
<?php print $detail_image;?>
<br>
<input type="file" name="image">
<br><br>
<p class="product_edit_text">詳細</p>
<textarea name="comments" style="width: 500px; height: 100px;"><?php print $rec['explanation'];?></textarea>
<br><br>
<input type="hidden" name="code" value="<?php print $rec['code'];?>">
<input type="hidden" name="old_image" value="<?php print $rec['image'];?>">
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>

</div>

<footer>
  <p class="mt-5 mb-3 text-body-secondary">©Shop武道 2023</p>
</footer>   
</body>
</html>