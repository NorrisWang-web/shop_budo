<?php

session_start();
session_regenerate_id(true);

if(isset($_SESSION["member_login"]) === false) {
    print "　ログインしてください。<br><br>";
    print "　<a href='../member_login/member_login.html'>ログイン画面へ</a>";
    exit();
} else {
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
<title>カート情報</title>
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
        
if(empty($_SESSION["cart"]) === true) {
    print "<div class='container text-center'>";
    print "カートに商品はありません。<br><br>";
    print "<a href='shop_list.php'>商品一覧へ戻る</a>";
    print "</div>";
    print "<br><br>";
    print "<footer><p class='mt-5 mb-3 text-body-secondary'>©Shop武道 2023</p></footer>";
    exit();
}

try{
$cart = $_SESSION["cart"];
$quantity = $_SESSION["quantity"];
$max = count($cart);
    
$dsn = "mysql:host=localhost;dbname=shop_budo;charset=utf8";
$user = "root";
$password = "";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
foreach($cart as $key => $val) {
    
$sql = "SELECT code, name, price, image FROM mst_product WHERE code=?";
$stmt = $dbh -> prepare($sql);
$data[0] = $val;
$stmt -> execute($data);
    
$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
    
$name[] = $rec["name"];
$price[] = $rec["price"];
$image[] = $rec["image"];
}
$dbh = null;
}
catch(Exception $e) {
    print "只今障害が発生しております。<br><br>";
    print "<a href='../member_login/member_login.html'>ログイン画面へ</a>";
}
?>

<h1 class="h3 mb-3 fw-normal">Shop武道</h1>

<header>
<h2 class="h4 mb-3 fw-normal center">カート一覧</h2>
</header>

<div class="container text-center">
    
<form action="shop_quantity.php" method="post">


<br><br>
<?php for($i = 0; $i < $max; $i++) {;?>
<?php if(empty($image[$i]) === true) {;?>
<?php $disp_image = "";?>
<?php } else {;?>
<?php $disp_image = "<img src='../product/image/".$image[$i]."'>";?>
<?php };?>
<?php print $disp_image;?>
<p>商品名：<?php print $name[$i];?></p>
<p>価格：<?php print $price[$i]."円　";?></p>
<p>数量：<input type="text" name="quantity<?php print $i;?>" value="<?php print $quantity[$i];?>"></p>
<p>合計価格：<?php print $price[$i] * $quantity[$i]."円";?></p>
<p>削除：<input type="checkbox" name="delete<?php print $i;?>"></p>
<br>

<?php };?>

<br><br>
<input type="hidden" name="max" value="<?php print $max;?>">
<input type="submit" value="数量変更/削除">
<br><br>
<input type="button" onclick="history.back()" value="戻る">
</form>
<br>
<a href="shop_form_check.php">ご購入手続きへ進む</a><br>
<br><br>

</div>
<footer>
    <p class="mt-5 mb-3 text-body-secondary">©Shop武道 2023</p>
</footer>
</body>
</html>