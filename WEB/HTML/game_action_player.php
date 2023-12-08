<?php 
  namespace task_game;
  session_start();
  if(!isset($_SESSION['user_id'])){
    header('location: ./login.php');
  }
  //クラスの読み込み
  include('../game/BattleController.php');
  include('../game/player.php');
  include('../game/EnumActionState.php');

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
  if(isset($_GET['attack'])) {
    // $damage_ =  $battle->attack($_SESSION['opponentId']);
    // $message = 'user_id:'.$_SESSION['user_id'].'が'.$damage_ .'のダメージを与えた';

    $message = 'user_id:' . $_SESSION['user_id'] . 'の攻撃！';

    //プレイヤーが防御or回避していたときのメッセージ
    if ($battle->getPlayerState() === EnumActionState::DEFENCE) {
      $message .= '<br>opponent_id:' . $_SESSION['opponent_id'] . 'は防御している';
    } elseif ($battle->getPlayerState() === EnumActionState::AVOID) {
      $message .= '<br>opponent_id:' . $_SESSION['opponent_id'] . 'は回避している';
    }

    //攻撃
    $damage_ = $battle->attack($_SESSION['opponentId']);
    $message .= '<br>user_id:' . $_SESSION['user_id'] .'は'. $damage_ . 'のダメージを与えた';

  } else if(isset($_GET['defence'])) {
    $battle->defence($_SESSION['user_id']);
    $message = 'user_id:'.$_SESSION['user_id'].'は防御した';

  } else if(isset($_GET['avoid'])) {
    //未実装
    //$battle->avoid();
    throw new \Exception('回避');
  } else {
    throw new \Exception('行動分岐エラー');
  }
  
  //プレイヤー操作を無効化
  $battle->disabledPlayerAction();

  
  //セッションの値を更新
  $_SESSION['player'] = serialize($battle->getPlayer());
  $_SESSION['opponent'] = serialize($battle->getOpponent());

  $_SESSION['battle'] = serialize($battle);

  $_SESSION['message'] = $message;

  header('location: ./game_battle.php');

?>
