<?php 
  namespace task_game;
  session_start();
  if(!isset($_SESSION['user_id'])){
    header('location: ./login.php');
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ランキング</title>
</head>
<?php
  require_once('../DAO/User.php');
  $user = new User();
  $user_id = $_SESSION['user_id'];
  $userName =  $user->getUserName($user_id);
?>
<body>
  <p>ユーザー名：<?=$userName?></p>
  <h1>ランキング</h1>
</body>
</html>