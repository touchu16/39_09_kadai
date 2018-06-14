<?php
$id = $_GET["id"];

//1.  DB接続します
include("functions.php");
$pdo = db_conn();


//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(":id",$id);
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  errorMsg($stmt);
}else{
    $rs = $stmt->fetch();
// 数字はユニークなものだからループさせる必要がない
//   //Selectデータの数だけ自動でループしてくれる
//   while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
//     $view .= '<p>';
//     $view .='<a href="detail.php?id='.$result["id"].'">';
//     $view .= $result["name"]."[".$result["indate"]."]<br>";
//     $view .= '</a>';
//     $view .= '</p>';
//   }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select2.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="update2.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ブックマーク</legend>
     <label>Name：   <input type="text" name="name" value="<?=$rs["name"]?>"></label><br>
     <label>書籍URL： <input type="text" name="url" value="<?=$rs["url"]?>"></label><br>
     <label>Comment : <textArea name="comment" rows="4" cols="40"><?=$rs["comment"]?></textArea></label><br>
     <input type="submit" value="送信">
     <input type="hidden" name="id" value="<?=$rs["id"]?>">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>

