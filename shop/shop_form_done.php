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
<title>商品購入決定画面</title>
<link rel="stylesheet" href="../style.css">
</head>
    
<body>
    
<?php
 try {   
        
require_once("../common/common.php");

$post = sanitize($_POST);
    
$name = $post["name"];
$email = $post["email"];
$address = $post["address"];
$tel = $post["tel"];
$cart = $_SESSION["cart"];
$quantity = $_SESSION["quantity"];
$max = count($cart);
    
print $name."様<br>";
print "ご注文ありがとうございました。<br>";
print $email."にメールを送りましたのでご確認下さい。<br>";
print "商品は入金を確認次第、下記の住所に発送させて頂きます。<br>";
print $address."<br>";
print $tel."<br>";
        
$order_text = "";
$order_text .= $name."様\n\nこの度はご注文ありがとうございました\n";
$order_text .= "\n";
$order_text .= "ご注文商品\n";
$order_text .= "-------------\n";
        
$dsn = "mysql:host=localhost;dbname=shop_budo;charset=utf8";
$user = "root";
$password = "";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
for($i = 0; $i < $max; $i++) {
    
$sql = "SELECT name, price FROM mst_product WHERE code=?";
$stmt = $dbh -> prepare($sql);
$data[0] = $cart[$i];
$stmt -> execute($data);
    
$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
    
$name = $rec["name"];
$price = $rec["price"];
$kakaku[] = $price;
$suryo = $quantity[$i];
$shokei = $price * $suryo;
    
$order_text .= $name."";
$order_text .= $price."円×";
$order_text .= $suryo."個=";
$order_text .= $shokei."円\n";
}

$sql = "LOCK TABLES data_sales_product WRITE";
$stmt = $dbh -> prepare($sql);
$stmt -> execute();
             
for($i = 0; $i < $max; $i++) {
$sql = "INSERT INTO data_sales_product(sales_member_code, code_product, price, quantity, time) VALUES(?,?,?,?,now())";
$stmt = $dbh -> prepare($sql);
$data = array();
$data[] = $_SESSION["member_code"];
$data[] = $cart[$i];
$data[] = $kakaku[$i];
$data[] = $quantity[$i];
$stmt -> execute($data);
}
        
$sql = "UNLOCK TABLES";        
$stmt = $dbh -> prepare($sql);
$stmt -> execute();
        
$dbh = null;
        
$order_text .= "送料は無料です。\n";
$order_text .= "-------------\n";
$order_text .= "\n";
$order_text .= "代金は以下の口座にお振込み下さい。\n";                                         
$order_text .= "A銀行　B支店　普通口座　1234567\n";
$order_text .= "入金が確認取れ次第、商品を発送させていただきます。\n";
$order_text .= "\n";
$order_text .= "◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆\n";
$order_text .= "　～SHOP武道～\n";
$order_text .= "\n";
$order_text .= "東京都六本木ヒルズ最上階\n";
$order_text .= "電話　090-0000-0000\n";
$order_text .= "メール　shopbudo@example.com\n";
$order_text .= "◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆◆\n";
print "<br>";
print nl2br($order_text);
        
$title = "ご注文ありがとうございました。";
$header = "From:shopbudo@example.com";
$order_text = html_entity_decode($order_text, ENT_QUOTES, "UTF-8");
mb_language("Japanese");
mb_internal_encoding("UTF-8");
mb_send_mail($email, $title, $order_text, $header);
        
$title = "お客様よりご注文が入りました。";
$header = "From:".$email;
$order_text = html_entity_decode($order_text, ENT_QUOTES, "UTF-8");
mb_language("Japanese");
mb_internal_encoding("UTF-8");
mb_send_mail("shopbudo@example.com", $title, $order_text, $header);
}

catch(Exception $e) {
    print "只今障害により大変ご迷惑をおかけしております。";
    exit();
}
    
?>
    
<br>
    <?php $_SESSION["cart"] = array();?>
    <?php $_SESSION["quantity"] = array();?>
    <a href="shop_list.php">商品画面へ</a>
<br><br>

</body>
</html>