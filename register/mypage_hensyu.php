<?php
ini_set('display_errors',1);
mb_internal_encoding("utf8");
//セッションスタート
session_start();

//mypage.php以外からの導線は　login_error_phpへリダイレクト
if(empty($_POST['from_mypage'])){
  header('Location:http://localhost/register/login_mypage/login_error.php');
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>マイページ登録</title>
  <link rel="stylesheet" type="text/css" href="mypage_hensyu.css" >
</head>
<body>
<header>
    <img src="./4eachblog_logo.jpg" >
    <div class="login"><a href="login_mypage/login.php">ログイン</a></div>
  </header>

  <main>
    <form action="mypage_update.php" method="post">
      <div class=member>
        <h2>会員情報</h2>
        <p>こんにちは！<?php echo $_SESSION['name'];?>さん</p>
        <div class="box1">
          <div class="box_left"><img src="<?php echo $_SESSION['picture']?>"></div>
          <div class="box_right">
            <label>氏名:</label><input type="text" name="name" value="<?php echo $_SESSION['name'];?>"><br>
            <label>メール:</label><input type="text" name="mail" value="<?php echo $_SESSION['mail'];?>"><br>
            <label>パスワード:</label><input type="text" name="password" value="<?php echo $_SESSION['password'];?>"><br>            
          </div>
        </div> 
        <div class="comments_area"> 
        <textarea name="comments"  cols="80" rows="5"> <?php echo $_SESSION['comments'];?></textarea>
        </div>         
        <input type="submit" class="button" value="この内容に変更する">
        <input type="hidden" value="<?php echo $_SESSION['id'];?>" name="id">
      </div>
    </form>
  </main>
  
  <footer>
    <div class=footer>
      ©️2018 InterNous.inc.All rights reserved
    </div>
  </footer>
</body>
</html>

