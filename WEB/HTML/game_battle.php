<?php
  namespace task_game;
  use task_game\EnumActionState;
  session_start();
  if(!isset($_SESSION['user_id'])){
    header('location: ./login.php');
  }

  if(isset($_SESSION['opponentId'])) {
    $opponentId = $_SESSION['opponentId'];
  } else {
    header('location: ./game_home.php');
  }

  require_once('../DAO/GameUser.php');
  $gameUser = new GameUser();
  require_once('../game/player.php');
  require_once('../game/BattleController.php');
  require_once('../game/EnumActionState.php');

  //プレイヤーの情報を取得
  $user_id = $_SESSION['user_id'];
  $userName =  $gameUser->getUserName($user_id);
  $userStatusLv = $gameUser->fetchUserStatusLv($user_id);
  //相手の情報を取得
  $opponentId = $_SESSION['opponentId'];
  $opponentName =  $gameUser->getUserName($opponentId);
  $opponentStatusLv = $gameUser->fetchUserStatusLv($opponentId);

  //対戦を開始
  //対戦中であればセッションからコントローラーを取得
  $message = '';
  if(isset($_SESSION['battle'])) {
    $battle = unserialize($_SESSION['battle']);
  } else {
    $message = '対戦を開始します<br>';
    $battle = new BattleController($user_id, $opponentId);
    $_SESSION['battle'] = serialize($battle);
    $_SESSION['player'] = serialize($battle->getPlayer());
    $_SESSION['opponent'] = serialize($battle->getOpponent());
  }
  //コントローラーから、プレイヤー・対戦相手のインスタンスを取得
  $player = $battle->getPlayer();
  $opponent = $battle->getOpponent();

  //操作ボタンのON/OFF
  $actionButton = "";
  $nextButton = "";
  $skillButton = "disabled";

  $isControllable = $battle->isControllable();
  $isSkillAvailable = $battle->isSkillAvailable($user_id);
  $isEnd = $battle->isEnd();

  $isControllable ? $actionButton = "" : $actionButton = "disabled";
  $isControllable ? $nextButton = "disabled" : $nextButton = "";
  $isSkillAvailable ? $skillButton = "" : $skillButton = "disabled";

  //ゲーム終了時はすべての操作ボタンを無効化
  if($isEnd) {
    $actionButton = "disabled";
    $nextButton = "disabled";
    $isSkillAvailable = "disabled";
  }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>対戦</title>
  <!--BootStrap CDN-->
  <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
  />
  <link rel="stylesheet" href="../CSS/game_battle.css?<?php echo date('YmdHis'); ?>">
</head>
<body>
  <div class="container-fluid">
    <h1>対戦画面</h1>
    <a href="./game_home.php">ホームへ戻る</a>
    <a href="./clear_battle_session.php">対戦セッションをクリア</a>
    <!-- 2人のデータをもとに、インスタンスを作る -->
    <div class="row">
      <div class="col-6">
        <h3>あなた：<?=$userName?> {id:<?=$user_id?>}</h3>
        <ul>
          <li>体力：<?=$player->getHP()?></li>
          <li>攻撃力：<?=$player->getATK()?></li>
          <li>防御力：<?=$player->getDEF() * 100?>%</li>
          <li>すばやさ：<?=$player->getAGL() * 100?>%</li>
          <li>幸運：<?=$player->getLUK() * 100?>%</li>
        </ul>

      </div>
      <div class="col-6">
        <h3>相手：<?=$opponentName?> {id:<?=$opponentId?>}</h3>
        <ul>
          <li>体力：<?=$opponent->getHP()?></li>
          <li>攻撃力：<?=$opponent->getATK()?></li>
          <li>防御力：<?=$opponent->getDEF() * 100?>%</li>
          <li>すばやさ：<?=$opponent->getAGL() * 100?>%</li>
          <li>幸運：<?=$opponent->getLUK() * 100?>%</li>
        </ul>
      </div>
    </div>

    <!-- スキル選択 -->
    <!-- 表示のきりかえ -->
    <div disabled>

    </div>


    <form action="./game_action_player.php" method="get">
      <button type="submit" name="attack" <?=$actionButton?>>攻撃する</button>
      <button type="submit" name="defence" <?=$actionButton?>>防御する</button>
      <button type="submit" name="avoid" <?=$actionButton?>>回避する</button>
      <button type="submit" name="skill" <?=$skillButton?>>スキルを発動する</button>
    </form>

    <div id="message">
      <p><?php
        if(isset($_SESSION['message'])) {
          $message = $_SESSION['message'];
          unset($_SESSION['message']);
        }
        
        echo $message;

        if($battle->isEnd()) {
          echo '<br>対戦終了';
          //TODO: 勝者の表示
          if($player->getActionState() == EnumActionState::DEAD) {
            echo '<br>あなたの負けです';
          } else {
            echo '<br>あなたの勝ちです';
          }
        }
      ?></p>
    </div>

    <form action="./game_action_opponent.php" method="post">
      <input type="submit" value="次のターンへ" <?=$nextButton?>>
    </form>
    
    <div <?=$isEnd ?  "": "hidden" ?>>
      <a href="./game_result.php"><button>対戦結果へ</button></a>
    </div>
    
  </div>
  <!-- BootStrap CDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
  </script>
</body>
</html>