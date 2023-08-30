<?php
// ユーザーがログインしているか、session_idを更新し、確認する
// ログインしていなかったら、ログイン画面へ誘導する
// ログインしていれば、「スタッフユーザー名」＋「さんログイン中」がが表示されます
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
<title>商品追加チェック</title>
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
$name = $post["name"];
$price = $post["price"];
$image = $_FILES["image"];
$comments = $post["comments"];
$cate = $post["cate"];

?>

<h1 class="h3 mb-3 fw-normal">追加商品情報</h1>
<p class="underline">カテゴリー</p>
<?php print $cate."<br><br>";?>

<p class="underline">商品名</p>
<?php
// 商品名が入力されていない場合に出るメッセージ、入力された場合は商品名が表示される
if(empty($name) === true) {
    print "商品名が入力されていません。<br><br>";
} else {
    print $name;
    print "<br><br>";
}
?>

<p class="underline">価格</p>
<?php
// 値段が入力されていない場合に出るメッセージ、入力された場合は「値段」＋「円」が表示される
if(preg_match("/\A[0-9]+\z/", $price) === 0) {
    print "正しい値を入力してください。<br><br>";
} else {
    print $price."円";
    print "<br><br>";
}
?>

<p class="underline">画像</p>
<?php
// 商品画像のファイルサイズを確認する。何かがアップされたら表示されるが、1000000を越えると画像が表示されず、大きすぎるメッセージが出る
if($image["size"] > 0) {
    if($image["size"] > 1000000) {
        print "ファイルのサイズが大きすぎます。<br><br>";
    } else {
        move_uploaded_file($image["tmp_name"],"./image/".$image["name"]);
        print "<img src='./image/".$image['name']."'>";
        print "<br><br>";
    }
}
?>

<p class="underline">詳細</p>
<?php
// 詳細のところに何も入力されなかったら、何かを書くように支持するメッセージが出る。
if(empty($comments) === true) {
    print "詳細が入力されていません。";
    print "<br><br>";
} 

// 詳細が100文字を越えると上限を越えたメッセージが出る、書かれた文章が表示されない。
if(mb_strlen($comments) > 100) {
    print "文字数は100文字が上限です。";
    print "<br><br>";
} 
// 100文字以内の詳細を入力されたら、内容がそのまま表示される。
else {
    print $comments;
    print "<br><br>";
}
?>
  
<?php
if(empty($name) or preg_match("/\A[0-9]+\z/", $price) === 0 or $image["size"] > 1000000 or empty($comments) or mb_strlen($comments) > 100) {
    print "<form>";
    print "<input type='button' onclick='history.back()' value='戻る'>";
    print "</form>";
} 
// 商品追加の確認メッセージは各項目が正しく入力された場合のみに表示され、商品追加するボタンが出る
else {
    print "上記商品を追加しますか？<br><br>";
    print "<form action='product_add_done.php' method='post'>";
    print "<input type='hidden' name='cate' value='".$cate."'>";
    print "<input type='hidden' name='name' value='".$name."'>";
    print "<input type='hidden' name='price' value='".$price."'>";
    print "<input type='hidden' name='image' value='".$image['name']."'>";
    print "<input type='hidden' name='comments' value='".$comments."'>"; 
    print "<input type='button' onclick='history.back()' value='戻る'>";
    print "<input type='submit' value='OK'>";
    print "</form>";
}
?>
</div>
    <footer>
        <p class="mt-5 mb-3 text-body-secondary">©Shop武道 2023</p>
    </footer>   
</body>
</html>