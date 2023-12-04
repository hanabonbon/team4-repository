<?php 
  session_start();
  if(!isset($_SESSION['user_id'])){
    header('location: ./login.php');
  }

  include('../game/BattleController.php');
  include('../game/player.php');

  $battle = unserialize($_SESSION['battle']);
  $player = unserialize($_SESSION['player']);
  $opponent = unserialize($_SESSION['opponent']);

  $battle->setPlayer($player);
  $battle->setOpponent($opponent);

  //確認用
  echo 'session/userId:'. $_SESSION['user_id']. '<br>';
  echo 'BattleController/userId:'. $battle->getPlayerId(). '<br>';

  $battle->attack($_SESSION['user_id']);

  $_SESSION['player'] = serialize($battle->getPlayer());
  $_SESSION['opponent'] = serialize($battle->getOpponent());
  
  $_SESSION['battle'] = serialize($battle);

  header('location: ./game_battle.php');

?>
