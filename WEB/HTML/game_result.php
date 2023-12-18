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
  <!--BootStrap CDN-->
  <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
  />
  <title>対戦結果</title>
  <link rel="stylesheet" href="../CSS/game_result.css?<?php echo date('YmdHis'); ?>">
  <link rel="stylesheet" href="../CSS/battle.css?<?php echo date('YmdHis'); ?>">
</head>
<?php
  require_once('../game/EnumActionState.php');
  require_once('../DAO/GameUser.php');
  require_once('../DAO/Test.php');
  require_once('../game/player.php');

  require_once('../game/BattleController.php');

  $gameUser = new GameUser();
  $test = new Test();

  $battle = unserialize($_SESSION['battle']);

  $playerId = $_SESSION['user_id'];
  $opponentId = $_SESSION['opponentId'];

  //レベル
  $playerLv = $gameUser->fetchLevel($playerId);
  $opponentLv = $gameUser->fetchLevel($opponentId);

  $rankPoint = 0;

  //レベル差に応じてランクポイントを決定
  if($battle->getWinnerId() === $playerId) {
    //プレイヤーが勝ったとき
    if($playerLv > $opponentLv) {
      $rankPoint = 5;
    } else if($playerLv === $opponentLv) {
      $rankPoint = 10;
    } else {
      $rankPoint = 15;
    }
  } else {
    //プレイヤーが負けたとき
    if($playerLv > $opponentLv) {
      $rankPoint = -20;
    } else if($playerLv === $opponentLv) {
      $rankPoint = -15;
    } else {
      $rankPoint = -5;
    }
  }

  //複数回更新されないようにする
  if(isset($_SESSION['isUpdated'])) {
    if($_SESSION['isUpdated'] == false) {
      $gameUser->updateRankPoint($playerId, $rankPoint);
      $_SESSION['isUpdated'] = true;
    }
  } else {
    $gameUser->updateRankPoint($playerId, $rankPoint);
    $_SESSION['isUpdated'] = true;
  }
  
?>
<body style="background-color:#FFEED5;">
  <div class="row">
    <div class="col-6 mt-5">
      <!-- プレイヤー側 -->
      <h2 class="text-center text-color">
        <?=$battle->getWinnerId() === $playerId ? 'WIN!' : 'LOSE';?>
      </h2>
      <div class="text-center">
        <img src="../images/<?=$gameUser->fetchIconPath($playerId)?>" alt="プレイヤーアイコン" class="img-icon">
      </div>
      <div class="text-center text-color">
        <h2 class="mt-2"><?=$gameUser->getUserName($playerId)?></h2>
        <h4><?= $test->getcountbattleresult($playerId,1); ?>勝<?= $test->getcountbattleresult($playerId,0); ?>敗</h4>
        <h4><?= $test->selectMyRanking($playerId); ?>位</h4>
      </div>
    </div>
    <div class="col-6 mt-5">
      <!-- 相手側 -->
      <h2 class="text-center text-color">
        <?=$battle->getWinnerId() === $opponentId ? 'WIN!' : 'LOSE';?>
      </h2>
      <div class="text-center">
          <img src="../images/<?=$gameUser->fetchIconPath($opponentId)?>" alt="相手のアイコン" class="img-icon">
      </div>
      <div class="text-center text-color">
          <h2 class="mt-2"><?=$gameUser->getUserName($opponentId)?></h2>
          <h4><?= $test->getcountbattleresult($opponentId,1); ?>勝<?= $test->getcountbattleresult($opponentId,0); ?>敗</h4>
          <h4><?= $test->selectMyRanking($opponentId); ?>位</h4>
      </div>
    </div>
  </div>
  <h3 class="text-center mt-5 text-color">取得ランクポイント：<?=$rankPoint?></h3>
  <div class="text-center mt-3">
  <a href="./game_clear.php"><button>対戦ホームへ戻る</button></a>
  </div>
  <?php
    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";
  ?>


  <!-- BootStrap CDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
  </script>
</body>
</html>