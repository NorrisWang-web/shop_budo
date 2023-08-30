<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION["login"]) === false) {
    print "　ログインしていません。<br><br>";
    print "　<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
    exit();
} else {
    print "　".$_SESSION["name"]."さんログイン中";
    print "<br><br>";
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>スタッフ削除確認</title>
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
    
<?php
    try{
    
$code = $_GET["code"];

$dsn = "mysql:host=localhost;dbname=shop_budo;charset=utf8";
$user = "root";
$password = "";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
$sql = "SELECT code, name FROM mst_staff WHERE code=?";
$stmt = $dbh -> prepare($sql);
$data[] = $code;
$stmt -> execute($data);
    
$dbh = null;
        
$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
        
}
catch(Exception $e) {
    print "只今障害が発生しております。<br><br>";
    print "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
}
?>

<h1 class="h3 mb-3 fw-normal">スタッフ情報</h1><br><br>
<p class="center">選択されたスタッフを削除する場合は「OK」ボタンを押してください。</p>
<p class="center">選択されたスタッフを削除せず、スタッフ一覧に戻る場合「戻る」ボタンを押してください。</p>
<div class="container text-center">   
<p class="underline">スタッフコード</p>
<?php print $rec["code"];?>
<br><br>
<p class="underline">スタッフネーム</p>
<?php print $rec["name"];?>
<br><br>
<p class="center">上記情報を削除しますか？</p>
<br><br>
<form action="staff_delete_done.php" method="post">
<input type="hidden" name="code" value="<?php print $rec['code'];?>">
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>
</div>

</body>
</html>