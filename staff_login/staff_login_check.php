<!-- 
このページは表示されず、スタッフログイン画面で送信されたログイン情報を処理し、
入力情報が正しいかどうかによって管理画面に進むかあるいはスタッフログイン画面に戻るように誘導されます。
-->
<?php
try {

require_once("../common/common.php");

$post = sanitize($_POST);
$code = $post["code"];
$pass = $post["pass"];

$pass = md5($pass);
    
$dsn = "mysql:host=localhost;dbname=shop_budo;charset=utf8";
$user = "root";
$password = "";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
$sql = "SELECT name FROM mst_staff WHERE code=? AND password=?";
$stmt = $dbh -> prepare($sql);
$data[] = $code;
$data[] = $pass;
$stmt -> execute($data);
    
$dbh = null;
    
$rec = $stmt -> fetch(PDO::FETCH_ASSOC);

// 入力情報間違ったら、エラー画面に遷移され、スタッフログイン画面に戻れるように誘導されます。
if(empty($rec["name"]) === true) {
    print "入力が間違っています。<br><br>";
    print "<a href='staff_login.html'>戻る</a>";
    exit();
// 入力情報間違っていなければ（正しい場合）スタッフログイン画面から管理画面に遷移されます。
} else {
    session_start();
    $_SESSION["login"] = 1;
    $_SESSION["name"] = $rec["name"];
    $_SESSION["code"] = $code;
    header("Location:staff_login_top.php");
    exit();
}
}
catch(Exception $e) {
    print "只今障害が発生しております。<br><br>";
    print "<a href='staff_login.html'>戻る</a>";
}
?>