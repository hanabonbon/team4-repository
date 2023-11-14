<?php
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
  <title>対戦</title>
</head>
<?php
  require_once('../DAO/GameUser.php');
  $gameUser = new GameUser();
  $opponentId = $_GET['opponent_user_id'];
  $opponent = $gameUser->findOnePlayerData($opponentId);
?>
<body>
  <h1>対戦画面</h1>
  <p>対戦相手：<?=$opponent['nickname']?>（id:<?=$opponent['user_id']?>）</p>
</body>
</html>