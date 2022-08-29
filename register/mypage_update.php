<?php
ini_set('display_errors',1);

mb_internal_encoding("utf8");
session_start();

try{
  //try catch文。DBに接続できなければエラーメッセージを表示
  $pdo=new PDO("mysql:dbname=lesson01;host=localhost;","root","root");
}catch(PDOException $e){
  die("<p>大変申し訳ございません。現在サーバーが混み合っており一時的にアクセスができません。<br>しばらくしてから再度ログインをしてください。</p>
  <a href='http://localhost/register/login_mypage/login.php'>ログイン画面へ</a>"
  );
}
//prepare(update文) bindValueでパラメータをセット
$stmt=$pdo->prepare("update login_mypage set name=?,mail=?,password=?,comments=? where id=?");

$stmt->bindValue(1,$_POST['name']);
$stmt->bindValue(2,$_POST['mail']);
$stmt->bindValue(3,$_POST['password']);
$stmt->bindValue(4,$_POST['comments']);
$stmt->bindValue(5,$_POST['id']);

$stmt->execute();

//preparedステートメント(更新された値をDBからselect文で取得)でSQLをセット$ //bindValueメソッドでパラメータをセット
$stmt=$pdo->prepare("select* from login_mypage where mail=? && password=?");
$stmt->bindValue(1,$_POST['mail']);
$stmt->bindValue(2,$_POST['password']);
//executeでクエリ実行
$stmt->execute();
//データベース切断
$pdo= NULL;

//fetch while 文でデータを取得し、セッションに代入
while($row=$stmt->fetch()){
  $_SESSION['id']= $row['id'];
  $_SESSION['name']= $row['name'];
  $_SESSION['mail']= $row['mail'];
  $_SESSION['password']= $row['password'];
  $_SESSION['picture']= $row['picture'];
  $_SESSION['comments']= $row['comments'];
  }

    header('Location:http://localhost/register/mypage.php');
?>