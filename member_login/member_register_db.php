<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>会員情報入力画面</title>
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
    
<h1 class="h3 mb-3 fw-normal">新規会員登録</h1><br><br>

<div class="container text-center">    

<form action="member_register_db_check.php" method="post">
<label for="name">名前</label><br>
<input type="text" name="name" id="name"><br>

<label for="email">email</label><br>
<input type="email" name="email" id="email"><br>

<label for="address">住所</label><br>
<input type="text" name="address" id="address"><br>

<label for="tel">電話番号</label><br>
<input type="tel" name="tel" id="tel"><br>

<label for="pass">パスワード</label><br>
<input type="password" name="pass" id="pass"><br>

<label for="pass2">パスワード再入力</label><br>
<input type="password" name="pass2" id="pass2">
<br><br>
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
<br><br>
   
</form>
<p><a href="../shop/shop_list.php">商品一覧へ</a></p>
</div>
<br><br>
<footer>
  <p class="mt-5 mb-3 text-body-secondary">©Shop武道 2023</p>
</footer>   
    
</body>
</html>