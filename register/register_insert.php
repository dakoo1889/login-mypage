<?php
mb_internal_encoding("utf8");
//DB接続
$pdo=new PDO("mysql:dbname=lesson01;host=localhost;","root","root");

//prepare statement でSQLの型をつくる
$stmt=$pdo->prepare("insert into login_mypage(name,mail,password,picture,comments)values(?,?,?,?,?)");

$stmt->bindValue(1,$_POST['name']);
$stmt->bindValue(2,$_POST['mail']);
$stmt->bindValue(3,$_POST['password']);
$stmt->bindValue(4,$_POST['path_filename']);
$stmt->bindValue(5,$_POST['comments']);

$stmt->execute();
$pdo=NULL;

header('Location:after_register.html');
?>