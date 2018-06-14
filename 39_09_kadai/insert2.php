<?php

if(
  !isset($_POST["name"])|| $_POST["name"]==""||
  !isset($_POST["url"])|| $_POST["url"]==""||
  !isset($_POST["comment"])|| $_POST["comment"]==""
){
 exit('ParamError');
}


//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
$name = $_POST["name"];
$url = $_POST["url"];
$com = $_POST["comment"];


//2. DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}
// xamppのため、hostがlocalhostとなる。また本番環境だとroot以下を変更する。ユーザー名および、パスワードの順番

//３．データ登録SQL作成

$sql = "INSERT INTO gs_bm_table(id,name,url,comment,indate)
VALUES(NULL, :a1, :a2, :a3, sysdate())";
// NULLの後に名前とかをダイレクトに入れるとハッキングされる可能性があるためbindValueを使用する

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $com, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();
// executeは実行すると言う意味

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("sqlError:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header ("Location: index2.php");
  // Location:のあとは必ず半角スペースを入力すること！！！エラーになります！！！


}
?>
