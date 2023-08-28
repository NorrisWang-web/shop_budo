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
<title>商品削除</title>
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
<div class="container text-center">
    
<?php
    try{
    
$code = $_GET["code"];

$dsn = "mysql:host=localhost;dbname=shop_budo;charset=utf8";
$user = "root";
$password = "";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
$sql = "SELECT code, name, price, image FROM mst_product WHERE code=?";
$stmt = $dbh -> prepare($sql);
$data[] = $code;
$stmt -> execute($data);
    
$dbh = null;
        
$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
        
$image = $rec["image"];
    
if(empty($image) === true) {
    $disp_image = "";
} else {
    $disp_image = "<img src='./image/".$image."'>";
}
               
}
catch(Exception $e) {
    print "只今障害が発生しております。<br><br>";
    print "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
}
?>

<h1 class="h3 mb-3 fw-normal">商品詳細</h1>    
<br><br>
<p class="underline">商品コード</p>
<?php print $rec["code"];?>
<br><br>
<p class="underline">商品名</p>
<?php print $rec["name"];?>
<br><br>
<p class="underline">価格</p>
<?php print $rec["price"];?>
円<br>
<br>
<p class="underline">画像</p>
<?php print $disp_image;?>
<br><br>
上記情報を削除しますか？<br><br>
<form action="product_delete_done.php" method="post">
<input type="hidden" name="code" value="<?php print $rec['code'];?>">
<input type="hidden" name="image" value="<?php print $image;?>">
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>
</div>
</body>
</html>