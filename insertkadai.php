<?php
//入力チェック(受信確認処理追加)
if(
    !isset($_POST["name"]) || $_POST["name"]=="" ||
    !isset($_POST["url"]) || $_POST["url"]=="" ||
    !isset($_POST["text"]) || $_POST["text"]==""
  ){
    exit('ParamError');
  }

//フォームのデータ受け取り
$name = $_POST["name"];
$url = $_POST["url"];
$text = $_POST["text"];

//2. DB接続します(エラー処理追加)
try {
    $pdo = new PDO("mysql:host=localhost;dbname=gs_db;charset=utf8",'root',''); //ID PASSの順番待ち
}catch (PDOException $e) {
    exit( 'DbConnectエラー:' . $e->getMessage()); //えらー手掛かり
}

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id, name, url, text,datetime )
VALUES(NULL, :a1, :a2, :a3, sysdate())");
$stmt->bindValue(':a1', $name);
$stmt->bindValue(':a2', $url);
$stmt->bindValue(':a3', $text);

//実際に実行
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);
  }else{
    //５．index.phpへリダイレクト
    header("Location: bm_list_view.php");
    exit;
  }
  ?>