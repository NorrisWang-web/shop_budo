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
<h2 class="h4 mb-3 fw-normal center">商品選択画面</h2>
<p id="target">menu</p>
</header>
<wrapper>
<main>
    
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
    $detail_image = "";
} else {
    $detail_image = "<img src='../product/image/".$rec['image']."'>";
}
    
}
catch(Exception $e) {
    print "只今障害が発生しております。<br><br>";
    print "<a href='../member_login/member_login.html'>ログイン画面へ</a>";
}
?>
<p>　<a href="shop_cart_add_to.php?code=<?php print $code;?>">カートに入れる</a></p>
<div class="box">
<div class="list">
<div class="img"><?php print $detail_image;?></div>
<br>
<div class="npe">
<p>商品名：<?php print $rec['name'];?></p>
<p>価格：<?php print $rec['price'];?>円</p>
<p>詳細：<?php print $rec['explanation'];?></p>
</div>
</div>
</div>
<br><br>
<form>
<input type="button" onclick="history.back()" value="戻る">
</form>

</main>
<aside>

<div class="box">
<h3>カテゴリー</h3>
<div class="d-flex justify-content-evenly">
    <a href="shop_list_dogi.php">道着</a>
    <a href="shop_list_bugu.php">武具</a>
    <a href="shop_list_book.php">書籍</a>
    <a href="shop_list_everyday.php">日用品</a>
    <a href="shop_list_other.php">その他</a>
</div>

</div>

<div class="box">
<h3>管理人：ノリス</h3>    
<div class="img"><a href="../staff_login/staff_login.html"><img src="../common/images/admin_pic.png"></a></div>
<p>あまり稼ぎにならない武道をネットショップで生活費を少し増やすことができたらと思います。</p>
</div>
<div class="box">
<h3>合気会</h3>
<div class="img"><a href="http://www.aikikai.or.jp/"><img src="../common/images/aikido_hombu.jpg"></a>
<p style="margin-top:10px;">合気道が好きです。本部道場は東京にあります。</p>
</div></div>
<div class="box">
<h3>GitHub</h3>
<div class="img"><a href="https://github.com/NorrisWang-web"><img src="../common/images/computer_user.png"></a>
<p>私のポートフォリオはGitHubで閲覧できます！</p>
</div></div>
</aside>
</wrapper>
<footer>
    <p class="mt-5 mb-3 text-body-secondary">©Shop武道 2023</p>
</footer>
</body>
</html>