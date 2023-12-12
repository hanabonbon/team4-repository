<?php 
  namespace task_game;
  session_start();
  if(isset($_SESSION['user_id'])){
    header('location: ./task_list.php');
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/login_check.css?<?php echo date('YmdHis'); ?>"/>
  <title>ログイン</title>
</head>
<body>
<div class="icon">
    <img src="../images/icon.png" alt="アイコン">
    </div>
  <?php
    require_once '../DAO/User.php';
    $user = new User();

    //メールアドレスの入力形式が正しいか判定
    if (!filter_var($_POST['mailaddress'], FILTER_VALIDATE_EMAIL)) {//入力形式が不正
      echo '<div class="error-message">正しいメールアドレスの形式で入力してください</div><br>';
      echo '<div class="login_link"><a href="./login.php">ログイン画面へ戻る</a></div>';
      exit;
    }

    //入力されたメールアドレスのアカウントが存在するか調べる
    $userData = $user->getUserDataByMail($_POST['mailaddress']);
    if(!isset($userData)) {//アカウントが無い
      echo '<div class="error-message">未登録のメールアドレスです</div>';
    } else {//アカウント有り
      //パスワードが一致するか確認
      if(password_verify($_POST['password'],$userData['password'])) {//パスワード一致
        //セッションにメールアドレスを入力（ログイン済みの証明とする）
        $_SESSION['user_id'] = $userData['user_id'];
        //ホームに遷移
        header('location: ./task_list.php');
      } else {//パスワードが一致しない
        echo '<div class="error-message">メールアドレス又はパスワードが間違っています</div>';
      }
    }
  ?>

  <!--入力画面へ戻るフォーム-->
  <div class="button">
  <form action="./login.php" method="post">
    <input type="hidden" name="mailaddress" value="<?=$_POST['mailaddress']; ?>">
    <input type="hidden" name="password" value="<?=$_POST['password']; ?>">
    <a href="./login.php">ログインへ戻る</a>
  </form>
  </div>
</body>
</html>
