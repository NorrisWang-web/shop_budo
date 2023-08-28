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
<title>Books</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sawarabi+Mincho&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link rel="stylesheet" href="../style.css">
</head>
    
<body>

<?php
try{

$dsn = "mysql:host=localhost;dbname=shop_budo;charset=utf8";
$user = "root";
$password = "";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
$sql = "SELECT code,name,price,image,explanation FROM mst_product WHERE category=?";
$stmt = $dbh -> prepare($sql);
$data[] = "書籍";
$stmt -> execute($data);
    
$dbh = null;
    
print "販売商品一覧";
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
    print $image;
    print "<br>";
    print "商品名:".$rec["name"];
    print "<br>";
    print "価格:".$rec["price"]."円";
    print "<br>";
    print "詳細:".$rec["explanation"];
    print "</a>";
    print "<br>";
}
print "<br>";

}
catch(Exception $e) {
    print "只今障害が発生しております。<br><br>";
    print "<a href='../member_login/member_login.html'>ログイン画面へ</a>";
}
?>
<a href="shop_list.php">トップページへ戻る</a>
<br><br><br>

<h3>カテゴリー</h3>
    <ul>
        <li><a href="shop_list_dogi.php">道着</a></li>
        <li><a href="shop_list_bugu.php">武具</a></li>
        <li><a href="shop_list_book.php">書籍</a></li>
        <li><a href="shop_list_everyday.php">日用品</a></li>
        <li><a href="shop_list_other.php">その他</a></li>
    </ul>
    
</body>
</html>