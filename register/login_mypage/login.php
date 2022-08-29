<?php
ini_set('display_errors',1);
session_start();
if(isset($_SESSION['id'])){
      header("Location:../mypage.php");
}
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイページ登録</title>
    <link rel="stylesheet" type="text/css" href="login.css" >
  </head>
  <body>
    <header>
        <img src="./4eachblog_logo.jpg" >
        <div class="login"><a href="login.php">ログイン</a></div>
    </header>
    <main>
      <form action="../mypage.php" method="post">
        <div class=login_form>
          <div class="mail">
            <label>メールアドレス</label><br>
            <input type="text" class="mail" size=40 value="<?php
                                        if(isset($_COOKIE['login_keep'])){
                                          echo $_COOKIE['mail'];
                                        }
                                        ?>" name="mail" required>
          </div>

          <div class="password">
            <label>パスワード</label><br>
            <input type="password" class="password" size=40 value="<?php
                                          if(isset($_COOKIE['login_keep'])){
                                          echo $_COOKIE['password'];
                                        }
                                        ?>" name="password" required>
          </div>

          <div class="keep">
            <label><input type="checkbox"  name="login_keep" value="login_keep"
            <?php
            if(isset($_COOKIE['login_keep'])){
              echo "checked='checked'";
            }
            ?>>ログイン状態を維持する</label>         
          </div>

          <input type="submit" class="button" value="ログイン" name="login">
        </div>
      </form>
    </main>
    <footer>
    ©️2018 InterNous.inc.All rights reserved
  </footer>
  </body>
</html>