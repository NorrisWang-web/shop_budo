<?php

session_start();
$_SESSION = array();
if(isset($_COOKIE[session_name()]) === true) {
    setcookie(session_name(), "", time()-42000, "/");
}
session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ログアウト</title>
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

<h1 class="h3 mb-3 fw-normal">ログアウトしました。</h1>
<main class="nav-align w-100 m-auto">
<div class="container text-center">
  <div class="row align-items-start">
    <div class="col">
    <a href="staff_login.html">スタッフログインへ</a>
    </div>
    <div class="col">
    <a href="../member_login/member_login.html">会員ログインへ</a>
    </div>
    <div class="col">
    <a href="../shop/shop_list.php">商品一覧へ</a>
    </div>
  </div>  
</div>
</main>
</body>
</html>