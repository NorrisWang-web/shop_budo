<?php

session_start();
session_regenerate_id(true);

if(isset($_SESSION["member_login"]) === true) {
print "ようこそ";
    print $_SESSION["member_name"];
    print "様　";
    print "<a href='../member_login/member_logout.php'>ログアウト</a>";
    print "<br><br>";
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>商品選択画面</title>
<link rel="stylesheet" href="../style.css">
</head>
    
<body>
    
<?php
try{

$code = $_GET["code"];
    
$dsn = "mysql:host=localhost;dbname=shop_budo;charset=utf8";
$user = "root";
$password = "";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
$sql = "SELECT code, name, price, image, explanation FROM mst_product WHERE code=?";
$stmt = $dbh -> prepare($sql);
$data[] = $code;
$stmt -> execute($data);
    
$dbh = null;
    
$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
    
if(empty($rec["image"]) === true) {
    $disp_image = "";
} else {
    $disp_image = "<img src='../product/image/".$rec['image']."'>";
}
    
}
catch(Exception $e) {
    print "只今障害が発生しております。<br><br>";
    print "<a href='../member_login/member_login.html'>ログイン画面へ</a>";
}
?>
<a href="shop_cart_add_to.php?code=<?php print $code;?>">カートに入れる</a>
<br><br>
<?php print $disp_image;?>
<br>
商品名:<?php print $rec['name'];?>
<br>
価格:<?php print $rec['price'];?>円
<br>
詳細:<?php print $rec['explanation'];?>

<br><br>
<form>
<input type="button" onclick="history.back()" value="戻る">
</form>

<h3>カテゴリー</h3>
<a href="shop_list_dogi.php">道着</a><br>
<a href="shop_list_bugu.php">武具</a><br>
<a href="shop_list_book.php">書籍</a><br>
<a href="shop_list_everyday.php">日用品</a><br>
<a href="shop_list_other.php">その他</a><br>

</body>
</html>