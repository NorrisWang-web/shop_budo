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
<title>商品詳細</title>
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
};
}

catch(Exception $e) {
    print "只今障害が発生しております。<br><br>";
    print "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
}
?>

<h1 class="h3 mb-3 fw-normal">商品詳細</h1>
<div class="container text-center">

<br><br>
<p class="underline">商品コード</p>
<?php print $rec["code"];?>
<br><br>
<p class="underline">カテゴリー</p>
<?php print $rec["category"];?>
<br><br>
<p class="underline">商品名</p>
<?php print $rec["name"];?>
<br><br>
<p class="underline">画像</p>
<?php print $detail_image;?>
<br><br>
<p class="underline">詳細</p>
<?php print $rec["explanation"];?>
<br><br>    
<form>
<input type="button" onclick="history.back()" value="戻る">
</form>

</div>
</body>
</html>