<?php

session_start();
session_regenerate_id(true);

if(isset($_SESSION["member_login"]) === false) {
    print "　ログインしてく下さい。<br><br>";
    print "　<a href='../member_login/member_login.html'>ログイン画面へ<br><br></a>";
    print "　<a href='shop_list.php'>商品一覧へ</a>";
    exit();
}
    if(isset($_SESSION["member_login"]) === true) {
    print "　ようこそ";
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
print "<a href='shop_cart_look.php'>カートを見る</a><br><br>";;
print "<a href='shop_list.php'>商品一覧へ戻る</a>";
}

?>
</div>
<br><br>
<footer>
    <p class="mt-5 mb-3 text-body-secondary">©Shop武道 2023</p>
</footer>
</body>
</html>