<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION["login"]) === false) {
    print "　ログインしていません。<br><br>";
    print "　<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
    exit();
}

if(isset($_POST["add"]) === true) {
    header("Location:staff_add.php");
    exit();
}

if(isset($_POST["detail"]) === true) {
    if(isset($_POST["code"]) === false) {
        header("Location:staff_ng.php");
        exit();
    } 
    $code = $_POST["code"];
    header("Location:staff_detail.php?code=".$code);
    exit();
}

if(isset($_POST["edit"]) === true) {
    if(isset($_POST["code"]) === false) {
        header("Location:staff_ng.php");
        exit();
    } 
    $code = $_POST["code"];
    header("Location:staff_edit.php?code=".$code);
    exit();
}

if(isset($_POST["delete"]) === true) {
    if(isset($_POST["code"]) === false) {
        header("Location:staff_ng.php");
        exit();
    } 
    $code = $_POST["code"];
    header("Location:staff_delete.php?code=".$code);
    exit();
}
?>