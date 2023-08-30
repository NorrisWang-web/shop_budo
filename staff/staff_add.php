<?php 
session_start();
session_regenerate_id(true);
if(isset($_SESSION["login"]) === false) {
   print "　ログインしていません。<br><br>";
   print "　<a href='staff_login.html'>ログイン画面へ</a>";
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
<title>スタッフ追加</title>
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
<h1 class="h3 mb-3 fw-normal">スタッフ追加</h1><br><br>

<div class="container text-center">
<form action="staff_add_check.php" method="post">

<label for="name">スタッフ名</label><br>
<input type="text" name="name" id="name">
<br><br>
<label for="pass">パスワード</label><br>
<input type="password" name="pass" id="pass">
<br><br>
<label for="pass2">パスワード再入力</label><br>
<input type="password" name="pass2" id="pass2">
<br><br>
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>    

</div>    
    <footer>
        <p class="mt-5 mb-3 text-body-secondary">©Shop武道 2023</p>
    </footer>   
</body>