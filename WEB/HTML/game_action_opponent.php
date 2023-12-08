<?php
  //相手の行動処理
  namespace task_game;
  use task_game\EnumActionState;
  session_start();
  if(!isset($_SESSION['user_id'])){
    header('location: ./login.php');
  }
  //クラスの読み込み
  include('../game/BattleController.php');
  include('../game/player.php');
  include('../game/OpponentAi.php');
  include('../game/EnumActionState.php');

  //セッションからオブジェクトを取得
  $battle = unserialize($_SESSION['battle']);
  $player = unserialize($_SESSION['player']);
  $opponent = unserialize($_SESSION['opponent']);

  //プレイヤーと相手のインスタンスを再設定
  $battle->setPlayer($player);
  $battle->setOpponent($opponent);


  //相手の行動
  //相手AIクラス
  //対戦コントローラーを渡す
  //行動の処理
  //対戦コントローラーを返す
  
  //修正
  //行うアクションをかえす

  $Ai = new OpponentAi();
  $action = $Ai->action();

  $damage_ = 0;

  // 相手の行動
  switch ($action) {
    case "attack":
      $message = 'opponent_id:' . $_SESSION['opponentId'] . 'の攻撃！';

      if ($battle->getPlayerState() === EnumActionState::DEFENCE) {
        $message .= '<br>player_id:' . $_SESSION['user_id'] . 'は防御している';
        //攻撃
        $damage_ = $battle->attack($_SESSION['user_id']);
        $message .= '<br>opponent_id:' . $_SESSION['opponentId'] .'は'. $damage_ . 'のダメージを与えた';

      } elseif ($battle->getPlayerState() === EnumActionState::AVOID) {
        //攻撃
        $damage_ = $battle->attack($_SESSION['user_id']);
        //このタイミングで回避結果がでる
        if($damage_ == 0) {
          $message .= '<br>user_id:' . $_SESSION['user_id'] . 'は回避した！';
        } else {
          $message .= '<br>user_id:' . $_SESSION['user_id'] . 'は回避に失敗した！';
          $message .= '<br>opponent_Id:' . $_SESSION['opponentId'] .'は'. $damage_ . 'のダメージを与えた';
        }

      } else {
        //攻撃
        $damage_ = $battle->attack($_SESSION['user_id']);
        $message .= '<br>opponent_id:' . $_SESSION['opponentId'] .'は'. $damage_ . 'のダメージを与えた';
      }
      break;

    case "defence":
      $battle->defence($_SESSION['opponentId']);
      $message = 'opponent_id:' . $_SESSION['opponentId'] . 'は防御した';
      break;

    case "avoid":
      $battle->avoid($_SESSION['opponentId']);
      $message = 'opponent_id:' . $_SESSION['opponentId'] . 'は回避姿勢をとった';
      //throw new \Exception('回避');
      break;

    default:
      throw new \Exception('行動分岐エラー');
  }
  
  //コントローラーの有効化
  $battle->enabledPlayerAction();

  //セッションの値を更新
  $_SESSION['player'] = serialize($battle->getPlayer());
  $_SESSION['opponent'] = serialize($battle->getOpponent());

  $_SESSION['battle'] = serialize($battle);

  $_SESSION['message'] = $message;

  header('location: ./game_battle.php');

?>