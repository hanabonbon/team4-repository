<?php 
  session_start();
  if(!isset($_SESSION['user_id'])){
    header('location: ./login.php');
  }
  //クラスの読み込み
  include('../game/BattleController.php');
  include('../game/player.php');
  include('../game/OpponentAi.php');

  //セッションからオブジェクトを取得
  $battle = unserialize($_SESSION['battle']);
  $player = unserialize($_SESSION['player']);
  $opponent = unserialize($_SESSION['opponent']);

  //プレイヤーと相手のインスタンスを再設定
  $battle->setPlayer($player);
  $battle->setOpponent($opponent);

  //確認用
  echo 'session/userId:'. $_SESSION['user_id']. '<br>';
  echo 'BattleController/userId:'. $battle->getPlayerId(). '<br>';

  //プレイヤーの行動
  //攻撃処理
  $battle->attack($_SESSION['user_id']);

  //相手の行動
  //相手AIクラス
  //対戦コントローラーを渡す
  //行動の処理
  //対戦コントローラーを返す
  $Ai = new OpponentAi($battle);
  $battle = $Ai->action();


  //セッションの値を更新
  $_SESSION['player'] = serialize($battle->getPlayer());
  $_SESSION['opponent'] = serialize($battle->getOpponent());

  $_SESSION['battle'] = serialize($battle);

  header('location: ./game_battle.php');

?>
