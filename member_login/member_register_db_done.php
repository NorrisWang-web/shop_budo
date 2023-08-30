<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>会員登録完了</title>
<link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
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
    try{

require_once("../common/common.php");

$post = sanitize($_POST);

$name = $post["name"];
$address = $post["address"];
$tel = $post["tel"];
$email = $post["email"];
$pass = $post["pass"];
        
$pass = md5($pass);
        
$dsn = "mysql:host=localhost;dbname=shop_budo;charset=utf8";
$user = "root";
$password = "";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
$sql = "SELECT email FROM member WHERE1";
$stmt = $dbh -> prepare($sql);
$stmt -> execute();
        
while(true) {
    $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
    if(empty($rec) === true) {
        break;
    }
    $mail[] = $rec["email"];
}

if(empty($mail) === true) {
    $mail[] = "a";
}
        
if(in_array($email, $mail) === true) {
    print "<h3>すでに使われているメールアドレスです。</h3><br>";
    /* パスワードを忘れた場合のパスワード再設定の機能は今付いていない */
    print "<a href='member_register_db.php'>会員登録画面へ戻る</a>";
    $dbh = null;
} else {   
$sql = "INSERT INTO member(name, email, address, tel, password) VALUES(?,?,?,?,?)";
$stmt = $dbh -> prepare($sql);
$data[] = $name;
$data[] = $email;
$data[] = $address;
$data[] = $tel;
$data[] = $pass;
$stmt -> execute($data);
        
$dbh = null;
        
 
print "登録完了しました。<br><br>";
print "<a href='../shop/shop_list.php'>商品一覧へ戻る</a>";
}
}
catch(Exception $e) {
   print "只今障害が発生しております。";
   print "a href='member_login.php'>ログインページへ戻る</a>";
   exit();
}
?>
<br><br>
    
</div>
<footer>
    <p class="mt-5 mb-3 text-body-secondary">©Shop武道 2023</p>
</footer>   
</body>
</html>