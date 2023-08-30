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
<title>商品追加</title>
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
<h1 class="h3 mb-3 fw-normal">商品追加</h1>
<div class="container text-center">

<!--  このフォームに入力した情報がデータベースに登録されます -->
<form action="product_add_check.php" method="post" enctype="multipart/form-data">

カテゴリー<br>
<?php 
require_once("../common/common.php");
?>
<?php print pulldown_cate();?>
<br><br>
商品名<br>
<input type="text" name="name">
<br><br>
価格<br>
<input type="text" name="price">
<br><br>
画像<br>
<input type="file" name="image">
<br><br>
詳細<br>
<textarea name="comments" style="width: 500px; height: 100px;"></textarea>
<br><br>
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form> 

</div>   
    <footer>
        <p class="mt-5 mb-3 text-body-secondary">©Shop武道 2023</p>
    </footer>   
</body>
</html>