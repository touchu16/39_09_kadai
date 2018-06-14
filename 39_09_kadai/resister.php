<?php

session_start();
include("functions.php");


if(isset($_POST['signup'])) {

$name = $_POST["name"];
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];
$lpw = password_hash($lpw, PASSWORD_DEFAULT);

$pdo = db_conn();



$sql = "INSERT INTO gs_user_table(id,name,lid,lpw)
VALUES(NULL, :a1, :a2, :a3,) ";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $name, PDO::PARAM_STR);
$stmt->bindValue(':a2', $lid, PDO::PARAM_STR);
$stmt->bindValue(':a3', $lpw, PDO::PARAM_STR);
$res = $stmt->execute();
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="css/main.css" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
<title>bookmark resister</title>
</head>

<body>
<form method="post">
    <h1>会員登録フォーム</h1>
    <div class="form-group">
    <input type="text" class="form-control" name="name" placeholder="ユーザー名" required />
  </div>
  <div class="form-group">
    <input type="email"  class="form-control" name="lid" placeholder="メールアドレス" required />
  </div>
  <div class="form-group">
    <input type="password" class="form-control" name="lpw" placeholder="パスワード" required />
  </div>
  <button type="submit" class="btn btn-default" name="signup">会員登録する</button>
  <a href="login2.php">ログインはこちら</a>
</form>




</body>