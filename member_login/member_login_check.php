<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ログインチェック</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sawarabi+Mincho&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link rel="stylesheet" href="../style.css">
</head>
    
<body class="align-items-center py-4 bg-body-tertiary">
<div class="container text-center">
    
<?php

require_once("../common/common.php");

$post = sanitize($_POST);

$email = $post["email"];
$pass = $post["pass"];
$pass2 = $post["pass2"];
$okflag = true;

if(empty($email) === true) {
    print "emailを入力してください。<br>";
    $okflag = false;
}
if(preg_match("/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/", $email) === 0) {
    print "正しいemailを入力してください。<br>";
    $okflag = false;
}
if(empty($pass) === true) {
    print "パスワードを入力してください。<br>";
    $okflag = false;
}
if($pass != $pass2) {
    print "パスワードが異なります<br>";
    $okflag = false;
}
if($okflag === false) {
    print "<form><br>";
    print "<input type='button' onclick='history.back()' value='戻る'>";
} else {
    print "<h3>下記メールアドレスでログインしますか？</h3><br>";
    print $email."<br><br>";
    print "<form action='member_login_done.php' method='post'>";
    print "<input type='hidden' name='email' value='".$email."'>";
    print "<input type='hidden' name='pass' value='".$pass."'>";
    print "<input type='button' onclick='history.back()' value='戻る'>";
    print "<input type='submit' value='ログイン'>";
}
?>

</div>
    <br><br>
    <footer>
        <p class="mt-5 mb-3 text-body-secondary">©Shop武道 2023</p>
    </footer>   
</body>
</html>