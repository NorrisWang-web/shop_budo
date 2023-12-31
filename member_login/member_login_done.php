<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ログイン成功</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sawarabi+Mincho&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link rel="stylesheet" href="../style.css">
</head>
    
<body class="align-items-center py-4 bg-body-tertiary">
<div class="container text-center">    

<?php
    try{

require_once("../common/common.php");

$post = sanitize($_POST);

$email = $post["email"];
$pass = $post["pass"];
        
$pass = md5($pass);
        
$dsn = "mysql:host=localhost;dbname=shop_budo;charset=utf8";
$user = "root";
$password = "";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
$sql = "SELECT code, name FROM member WHERE email=? AND password=?";
$stmt = $dbh -> prepare($sql);
$data[] = $email;
$data[] = $pass;
$stmt -> execute($data);
        
$dbh = null;
        
$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
        
if(empty($rec["name"]) === true) {
    print "ログイン情報が間違っています。<br>";
    print "<a href='member_login.html'>戻る</a>";
    exit();
} 
session_start();
$_SESSION["member_login"] = 1;
$_SESSION["member_name"] = $rec["name"];
$_SESSION["member_code"] = $rec["code"];
print "ログイン成功しました。<br><br>";
print "<a href='../shop/shop_list.php'>商品一覧トップへ</a>";
        
}
catch(Exception $e) {
   print "只今障害が発生しております。";
   print "a href='member_login.php'>ログインページへ戻る</a>";
   exit();
}
?>
</div>
    <br><br>
    <footer>
        <p class="mt-5 mb-3 text-body-secondary">©Shop武道 2023</p>
    </footer>
</body>
</html>