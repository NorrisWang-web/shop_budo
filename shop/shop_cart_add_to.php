<?php

session_start();
session_regenerate_id(true);

if(isset($_SESSION["member_login"]) === false) {
    print "ログインしてく下さい。<br><br>";
    print "<a href='../member_login/member_login.html'>ログイン画面へ<br><br></a>";
    print "<a href='shop_list.php'>TOP画面へ</a>";
    exit();
}
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
<title>カートに追加</title>
<link rel="stylesheet" href="../style.css">
</head>
    
<body>

<?php
    
$code = $_GET["code"];

if(isset($_SESSION["cart"]) === true) {
    $cart = $_SESSION["cart"];
    $quantity = $_SESSION["quantity"];
        if(in_array($code, $cart) === true) {
        print "すでにカートにあります。<br><br>";
        print "<a href='shop_list.php'>商品一覧へ戻る</a>";
        } 
        }
if(empty($_SESSION["cart"]) === true or in_array($code, $cart) === false) {
$cart[] = $code;
$quantity[] = 1;
$_SESSION["cart"] = $cart;
$_SESSION["quantity"] = $quantity;

print "カートに追加しました。<br><br>";
print "<a href='shop_list.php'>商品一覧へ戻る</a>";
}

?>
<br><br>

</body>
</html>