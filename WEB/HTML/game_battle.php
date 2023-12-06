<?php
  namespace task_game;
  use task_game\EnumActionState;
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
  <!--BootStrap CDN-->
  <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
  />
  <link rel="stylesheet" href="../CSS/game_battle.css?<?php echo date('YmdHis'); ?>">
</head>
<?php
  require_once('../DAO/GameUser.php');
  $gameUser = new GameUser();
  require_once('../game/player.php');
  require_once('../game/BattleController.php');
  require_once('../game/EnumActionState.php');

  //自分
  $user_id = $_SESSION['user_id'];
  $userName =  $gameUser->getUserName($user_id);
  $userStatusLv = $gameUser->fetchUserStatusLv($user_id);

  //相手
  if(isset($_GET['opponent_user_id'])) {
    $_SESSION['opponentId'] = $_GET['opponent_user_id'];
  }

  $opponentId = $_SESSION['opponentId'];
  
  $opponentName =  $gameUser->getUserName($opponentId);
  $opponentStatusLv = $gameUser->fetchUserStatusLv($opponentId);

  //対戦を開始
  if(isset($_SESSION['battle'])) {
    $battle = unserialize($_SESSION['battle']);
  } else {
    echo '対戦を開始します<br>';
    $battle = new BattleController($user_id, $opponentId);
    $_SESSION['battle'] = serialize($battle);
    $_SESSION['player'] = serialize($battle->getPlayer());
    $_SESSION['opponent'] = serialize($battle->getOpponent());
  }

  $isControllable = $battle->isControllable();
  //$isControllable = true;

  $player = $battle->getPlayer();
  $opponent = $battle->getOpponent();

  $message = '';
?>
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

        <form action="./game_action_player.php" method="get">
          <input type="submit" value="攻撃" name="attack"<?=$isControllable ? "" : "disabled"?>>
          <input type="submit" value="防御" name="defence"<?=$isControllable ? "" : "disabled"?>>
        </form>

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

    <div id="message">
      <p><?php
        //処理を遅延させて自分の行動→相手の行動の順番に表示する
        $message = "相手に攻撃しました。";
        echo $message;
      ?></p>
    </div>

    <form action="./game_action_opponent.php" method="post">
      <input type="submit" value="次のターンへ" <?=$isControllable ? "disabled" : ""?>>
    </form>
    
  </div>
  <!-- BootStrap CDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
  </script>
</body>
</html>