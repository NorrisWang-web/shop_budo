<?php

session_start();
session_regenerate_id(true);

require_once("../common/common.php");

$post = sanitize($_POST);
$max = $post["max"];
$cart = $_SESSION["cart"];

for($i = 0; $i < $max; $i++) {
    if(preg_match("/\A[0-9]+\z/", $post['quantity'.$i]) === 0) {
        print "<h3 style='text-align:center;'>正確な数を入力してください。</h3><br>";
        print "<p style='text-align:center;'><a href='shop_cart_look.php'>戻る</a></p>";
        exit();
    }
    if($post["quantity".$i] <= 0 or $post["quantity".$i] > 10) {
        print "<h3 style='text-align:center;'>　0以上、10が上限になります。</h3><br>";
        print "<p style='text-align:center;'><a href='shop_cart_look.php'>戻る</a></p>";
        exit();
    }
    $quantity[] = $post["quantity".$i];
}

for($i = $max; $i >= 0; $i--) {
    if(isset($post["delete".$i]) === true) {
        array_splice($cart, $i, 1);
        array_splice($quantity, $i, 1);
}
}
$_SESSION["cart"] = $cart;
$_SESSION["quantity"] = $quantity;
header("Location:shop_cart_look.php");
exit();
?>