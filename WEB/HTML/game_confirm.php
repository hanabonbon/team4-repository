<?php
  namespace task_game;
  use task_game\EnumActionState;

  session_start();
  if(!isset($_SESSION['user_id'])){
    header('location: ./login.php');
  }
  $_SESSION['opponentId'] = $_GET['opponent_user_id'];

  require_once('../DAO/GameUser.php');
  require_once('../game/player.php');
  require_once('../game/EnumActionState.php');

  $gameUser = new GameUser();
  $opponentId = $_SESSION['opponentId'];
  
  $opponentName =  $gameUser->getUserName($opponentId);
  $opponentStatusLv = $gameUser->fetchUserStatusLv($opponentId);

  $opponent = new Player($opponentStatusLv);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>対戦相手の確認</title>
  <link rel="stylesheet" href="../CSS/game_confirm.css?<?php echo date('YmdHis'); ?>">
</head>
<body>
  <img src="" alt="アイコン">
  <h2>相手：<?=$opponentName?> {id:<?=$opponentId?>}</h2>
  <h3>レベル：<?=$gameUser->fetchLevel($opponentId)?></h3>
    <ul>
      <li>体力：<?=$opponent->getHP()?></li>
      <li>攻撃力：<?=$opponent->getATK()?></li>
      <li>防御力：<?=$opponent->getDEF() * 100?>%</li>
      <li>すばやさ：<?=$opponent->getAGL() * 100?>%</li>
      <li>幸運：<?=$opponent->getLUK() * 100?>%</li>
    </ul>

    <a href="./game_battle.php"><button>対戦する</button></a>
</body>
</html>