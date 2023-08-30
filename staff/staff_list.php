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
<title>スタッフ一覧</title>
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
    
$dsn = "mysql:host=localhost;dbname=shop_budo;charset=utf8";
$user = "root";
$password = "";
$dbh = new PDO($dsn, $user, $password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
$sql = "SELECT code,name FROM mst_staff WHERE1";
$stmt = $dbh -> prepare($sql);
$stmt -> execute();
    
$dbh = null;
?>

<h1 class="h3 mb-3 fw-normal">スタッフ一覧</h1><br>
<div class="container text-center">    

<?php print "<form action='staff_branch.php' method='post'>";
    
while(true) {
    $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
    if($rec === false) {
        break;
    }
    print "<input type='radio' name='code' value='".$rec['code']."'> ";
    print $rec["name"];
    print "<br>";
}
print "<br>";
print "<input type='submit' name='detail' value='詳細'>";
print "<input type='submit' name='add' value='追加'>";
print "<input type='submit' name='edit' value='修正'>";
print "<input type='submit' name='delete' value='削除'>";
}
catch(Exception $e) {
    print "只今障害が発生しております。<br><br>";
    print "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
}
?>
<br><br>
<div>
<a href="../staff_login/staff_login_top.php">管理画面TOPへ</a>
</div>

</div>
    <footer>
        <p class="mt-5 mb-3 text-body-secondary">©Shop武道 2023</p>
    </footer>   
</body>
</html>