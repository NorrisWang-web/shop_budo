<?php

session_start();
session_regenerate_id(true);

if(isset($_SESSION["member_login"]) === false) {
    print "　ログインしてく下さい。<br><br>";
    print "　<a href='../member_login/member_login.html'>ログイン画面へ<br><br></a>";
    print "　<a href='shop_list.php'>TOP画面へ</a>";
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
<title>商品購入チェック</title>
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

<h1 class="h3 mb-3 fw-normal">Shop武道</h1>

<header>
<h2 class="h4 mb-3 fw-normal center">チェックアウト</h2>
</header>

<div class="container text-center">

<?php
    try {

$member_code = $_SESSION["member_code"];
$cart = $_SESSION["cart"];
$quantity = $_SESSION["quantity"];
$max = count($quantity);
        
$dsn = "mysql:host=localhost;dbname=shop_budo;charset=utf8";
$user = "root";
$password = "";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
$sql = "SELECT name, email, address, tel FROM member WHERE code=?";
$stmt = $dbh -> prepare($sql);
$data[] = $member_code;
$stmt -> execute($data);
       
$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
        
print "下記内容でよろしいでしょうか？<br><br>";
print "【宛先】<br>";
print "お名前：".$rec['name']."様<br>";
print "メールアドレス：".$rec['email']."<br>";
print "ご住所：".$rec['address']."<br>";
print "ご連絡先：".$rec['tel']."<br><br>";
$name = $rec["name"];
$email = $rec["email"];
$address = $rec["address"];
$tel = $rec["tel"];
?>

</div>
<div class="checkout">

<?php
print "【ご注文内容】<br>";
for($i = 0; $i < $max; $i++) {
  $sql = "SELECT name, price, image FROM mst_product WHERE code=?";
  $stmt = $dbh -> prepare($sql);
  $data = array();
  $data[] = $cart[$i];
  $stmt -> execute($data);
    
$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
    
if(empty($rec["image"]) === true) {
$detail_image = "";
} else {
$detail_image = "<img src='../product/image/".$rec['image']."'>";
}
print "<div class='box'>";
print "<div class='list'>";
print "<div class='img'>";
print $detail_image;
print "</div>";
print "<div class='npe'>";
print "商品名：".$rec['name']."<br>";
print "価格：".$rec['price']."円　<br>";
print "数量：".$quantity[$i]."<br>";
print "合計価格：".$rec['price'] * $quantity[$i]."円<br><br>";
$total[] = $rec['price'] * $quantity[$i];
print "</div></div></div><br>";
}
?>

</div>
<div class="container text-center">

<?php
$dbh = null; 
print "【ご請求金額】--- ".array_sum($total)."円<br><br>";
print "<form action='shop_form_done.php' method='post'>";
print "<input type='hidden' name='name' value='".$name."'>";
print "<input type='hidden' name='email' value='".$email."'>";
print "<input type='hidden' name='address' value='".$address."'>";
print "<input type='hidden' name='tel' value='".$tel."'>";
print "<input type='button' onclick='history.back()' value='戻る'>";
print "<input type='submit' value='OK'>";
print "</form>";
}

catch(Exception $e) {
    print "　只今障害が発生しております。<br><br>";
    print "　<a href='../member_login/member_login.html'>ログイン画面へ</a>";
}
?>
</div>
    
</body>
</html>