<?php
//入力チェック(受信確認処理追加)
if(
  !isset($_POST["name"]) || $_POST["name"]=="" ||
  !isset($_POST["url"]) || $_POST["url"]=="" ||
  !isset($_POST["comment"]) || $_POST["comment"]==""
){
  exit('ParamError');
}

//1. POSTデータ取得
$id     = $_POST["id"];
$name   = $_POST["name"];
$url    = $_POST["url"];
$com    = $_POST["comment"];

//2. DB接続します(エラー処理追加)
include("functions.php");
$pdo = db_conn();


//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE gs_bm_table SET name=:a1, url=:a2, comment=:a3 WHERE id=:id");
$stmt->bindValue(':a1', $name);
$stmt->bindValue(':a2', $url);
$stmt->bindValue(':a3', $com);
$stmt->bindValue(':id', $id);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  errorMsg($stmt);
}else{
  header("Location: select2.php");
  exit;
}
?>
