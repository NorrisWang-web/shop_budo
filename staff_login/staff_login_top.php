<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION["login"]) === false) {
    print "　ログインしていません。<br><br>";
    print "　<a href='staff_login.html'>ログイン画面へ</a>";
    exit();
} else {
    print "　";
    print $_SESSION["name"]."さんログイン中";
    print "<br><br>";
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>管理画面TOP</title>
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

<h1 class="h3 mb-3 fw-normal">管理画面TOP</h1>
<main class="nav-align w-100 m-auto">
<div class="container text-center">
  <div class="row align-items-start">
    <div class="col">
    <a href="../staff/staff_list.php">スタッフ管理</a>
    </div>
    <div class="col">
    <a href="../product/product_list.php">商品管理</a>
    </div>
    <div class="col">
    <a href="staff_logout.php">ログアウト</a>
    </div>
  </div>
</div>

</main>
<footer>
  <p class="mt-5 mb-3 text-body-secondary">©Shop武道 2023</p>
</footer>   

</body>
</html>