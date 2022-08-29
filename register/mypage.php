<?php
ini_set('display_errors',1);

mb_internal_encoding("utf8");
session_start();

if(empty($_SESSION['id'])){
  try{
    //try catch文。DBに接続できなければエラーメッセージを表示
    $pdo=new PDO("mysql:dbname=lesson01;host=localhost;","root","root");
  }catch(PDOException $e){
    die("<p>大変申し訳ございません。現在サーバーが混み合っており一時的にアクセスができません。<br>しばらくしてから再度ログインをしてください。</p>
    <a href='http://localhost/login_mypage/login.php'>ログイン画面へ</a>"
    );
  }


    //プリペアードステートメントでSQLの文の型を作る。 DBとPOSTデータを照合させる
  $stmt=$pdo->prepare("select * from login_mypage where mail=? && password=?");

  $stmt->bindValue (1,$_POST["mail"]);
  $stmt->bindValue (2,$_POST["password"]);

    $stmt->execute();

    $pdo= NULL;

    //fetch・while文でデータを取得し、sessionに代入

    while($row=$stmt->fetch()){
      $_SESSION['id']=$row['id'];
      $_SESSION['name']=$row['name'];
      $_SESSION['mail']=$row['mail'];
      $_SESSION['password']=$row['password'];
      $_SESSION['picture']=$row['picture'];
      $_SESSION['comments']=$row['comments'];
      }

      //データ取得ができずに(empty使用)sessionがなければ、リダイレクト(エラー画面へ)
      if(empty($_SESSION['id'])){
        header('Location:http://localhost/register/login_mypage/login_error.php');
      }
      if(!empty($_POST['login_keep'])){
        $_SESSION['login_keep']=$_POST['login_keep'];
      }
}

if(!empty($_SESSION['id']) && !empty($_SESSION['login_keep'])){
  setcookie('mail',$_SESSION['mail'],time()+60*60*24*7);
  setcookie('password',$_SESSION['password'],time()+60*60*24*7);
  setcookie('login_keep',$_SESSION['login_keep'],time()+60*60*24*7);
  } else if(empty($_SESSION['login_keep'])){
  setcookie('mail','',time()-1);
  setcookie('password','',time()-1);
  setcookie('login_keep','',time()-1);
  }


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>マイページ登録</title>
  <link rel="stylesheet" type="text/css" href="mypage.css" >
</head>
<body>
  <header>
      <img src="./4eachblog_logo.jpg" >
      <div class="login"><a href="login_mypage/log_out.php">ログアウト</a></div>
  </header>

  <main>
      <div class=member>
        <h2>会員情報</h2>
        <?php echo "こんにちは！".$_SESSION['name']."さん";?>
        <div class="box1">
          <div class="box_left"><img src="<?php echo $_SESSION['picture']?>"></div>
          <div class="box_right">
            <label>氏名:<?php echo $_SESSION['name'];?></label><br>
            <label>メール:<?php echo $_SESSION['mail'];?></label><br>
            <label>パスワード:<?php echo $_SESSION['password'];?></label>
          </div>
        </div> 
        <div class="comments_area"> 
          <p><?php echo $_SESSION['comments'];?></p>
        </div> 
        <form action="mypage_hensyu.php" method="post" class="form_center">
          <input type="hidden" value="<?php echo rand(1,10);?>" name="from_mypage"> 
          <input type="submit" class="button" value="編集する">
        </form>
      </div>
  </main>
  
  <footer>
    ©️2018 InterNous.inc.All rights reserved
  </footer>
</body>
</html>