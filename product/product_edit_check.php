<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION["login"]) === false) {
    print "ログインしていません。<br><br>";
    print "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
    exit();
} else {
    print $_SESSION["name"]."さんログイン中";
    print "<br><br>";
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>商品内容変更チェック</title>
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
    
require_once("../common/common.php");
    
$post = sanitize($_POST);
$code = $post["code"];
$name = $post["name"];
$price = $post["price"];
$image = $_FILES["image"];
$old_image = $post["old_image"];
$comments = $post["comments"];
$cate = $post["cate"];
    
if(empty($name) === true) {
    print "商品名が入力されていません。<br><br>";
} else {
    print $name;
    print "<br><br>";
}
    
if(preg_match("/\A[0-9]+\z/", $price) === 0) {
    print "正しい値を入力してください。<br><br>";
} else {
    print $price."円";
    print "<br><br>";
}
    
if($image["size"] > 0) {
    if($image["size"] > 1000000) {
        print "ファイルのサイズが大きすぎます。<br><br>";
    } else {
        move_uploaded_file($image["tmp_name"],"./image/".$image["name"]);
        print "<img src='./image/".$image['name']."'>";
        print "<br><br>";
    }
}
if($image["name"] === "") {if($old_image != "") {print "<img src='./image/".$old_image."'>" ;}} 
print "<br><br>";

if(empty($comments) === true) {
    print "詳細が入力されていません。";
    print "<br><br>";
} 
if(mb_strlen($comments) > 100) {
    print "文字数は100文字が上限です。";
    print "<br><br>";
} else {
    print $comments;
    print "<br><br>";
}

    
if(empty($name) or preg_match("/\A[0-9]+\z/", $price) === 0 or $image["size"] > 1000000 or empty($comments) === true or mb_strlen($comments) > 100) {
    print "<form>";
    print "<input type='button' onclick='history.back()' value='戻る'>";
    print "</form>";
} else {
    print "上記商品を修正しますか？<br><br>";
    print "<form action='product_edit_done.php' method='post'>";
    print "<input type='hidden' name='cate' value='".$cate."'>";
    print "<input type='hidden' name='code' value='".$code."'>";
    print "<input type='hidden' name='name' value='".$name."'>";
    print "<input type='hidden' name='price' value='".$price."'>";
    print "<input type='hidden' name='image' value='".$image['name']."'>";
    print "<input type='hidden' name='old_image' value='".$old_image."'>";
    print "<input type='hidden' name='explanation' value='".$comments."'>";
    print "<input type='button' onclick='history.back()' value='戻る'>";
    print "<input type='submit' value='OK'>";
    print "</form>";
}
?>
</div>
</body>
</html>