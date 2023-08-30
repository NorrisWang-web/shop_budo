<?php
session_start();
session_regenerate_id(true);

if(isset($_SESSION["member_login"]) === true) {
print "　ようこそ";
    print $_SESSION["member_name"];
    print "様　";
    print "<a href='../member_login/member_logout.php'>ログアウト</a>";
    print "<br><br>";
}

if(isset($_SESSION["member_login"]) === false) {
    print "　";  
    print "<a href='../member_login/member_login.html'>ログイン画面へ</a>";
    print "<br><br>";
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bugu</title>
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
<h2 class="h4 mb-3 fw-normal center">武具</h2>
<p id="target" class="pad_right"><a href="#menu">menu</a></p>
</header>

<wrapper>
<main>
    
<?php
try{

$dsn = "mysql:host=localhost;dbname=shop_budo;charset=utf8";
$user = "root";
$password = "";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
$sql = "SELECT code,name,price,image,explanation FROM mst_product WHERE category=?";
$stmt = $dbh -> prepare($sql);
$data[] = "武具";
$stmt -> execute($data);
    
$dbh = null;
    
print "　<a href='shop_cart_look.php'>カートを見る</a>";
print "<br><br>";
    
while(true) {
    $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
    if($rec === false) {
        break;
    }
    $code = $rec["code"];
    print "<a href='shop_product.php?code=".$code."'>";
    if(empty($rec["image"]) === true) {
        $image = "";
    } else {
        $image = "<img src='../product/image/".$rec['image']."'>";
    }
    print "<div class='box'>";
    print "<div class='list'>";
    print "<div class='img'>";
    print $image;
    print "</div>";
    print "<div class='npe'>";
    print "<br>";
    print "商品名:".$rec["name"];
    print "</a>";
    print "<br>";
    print "価格:".$rec["price"]."円";
    print "<br>";
    print "詳細:".$rec["explanation"];
    print "</div>";
    print "</div>";
    print "</div>";
    print "<br>";
}
print "<br>";

}
catch(Exception $e) {
    print "只今障害が発生しております。<br><br>";
    print "<a href='../member_login/member_login.html'>ログイン画面へ</a>";
}
?>
<p>　<a href="shop_list.php">商品一覧へ戻る</a></p>
<br><br><br>

<nav id="menu" class="close">
<h3>カテゴリー</h3>
    <ul>
        <li><a href="shop_list_dogi.php">道着</a></li>
        <li><a href="shop_list_bugu.php">武具</a></li>
        <li><a href="shop_list_book.php">書籍</a></li>
        <li><a href="shop_list_everyday.php">日用品</a></li>
        <li><a href="shop_list_other.php">その他</a></li>
    </ul>
</nav>

    <div id="back" class="white"></div>
    <div id="scrolltop" class="st">⇧</div>
    <div id="scrollmenu" class="sm">MENU</div>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="../main.js"></script>
<script src="../anime.min.js"></script>
</body>
</html>