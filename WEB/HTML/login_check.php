<?php 
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
  <title>ログイン</title>
</head>
<body>
  <?php
    require_once '../DAO/User.php';
    $user = new User();

    //メールアドレスの入力形式が正しいか判定
    if (!filter_var($_POST['mailaddress'], FILTER_VALIDATE_EMAIL)) {//入力形式が不正
      echo '<b>正しいメールアドレスの形式で入力してください</b><br>';
      echo '<a href="./login.php">ログイン画面へ戻る</a>';
      exit;
    }

    //入力されたメールアドレスのアカウントが存在するか調べる
    $userData = $user->getUserDataByMail($_POST['mailaddress']);
    if(!isset($userData)) {//アカウントが無い
      echo '<p>未登録のメールアドレスです</p>';
    } else {//アカウント有り
      //パスワードが一致するか確認
      if(password_verify($_POST['password'],$userData['password'])) {//パスワード一致
        //セッションにメールアドレスを入力（ログイン済みの証明とする）
        $_SESSION['user_id'] = $userData['user_id'];
        //ホームに遷移
        header('location: ./task_list.php');
      } else {//パスワードが一致しない
        echo '<p>メールアドレス又はパスワードが間違っています</p>';
      }
    }
  ?>

  <!--入力画面へ戻るフォーム-->
  <form action="./login.php" method="post">
    <input type="hidden" name="mailaddress" value="<?=$_POST['mailaddress']; ?>">
    <input type="hidden" name="password" value="<?=$_POST['password']; ?>">
    <button type="submit">ログインへ戻る</button>
  </form>
</body>
</html>
