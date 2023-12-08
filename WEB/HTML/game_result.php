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
</head>
<?php
  require_once('../game/EnumActionState.php');
  require_once('../DAO/GameUser.php');
  require_once('../game/player.php');

  require_once('../game/BattleController.php');

  $gameUser = new GameUser();

  $battle = unserialize($_SESSION['battle']);

  $playerId = $_SESSION['user_id'];
  $opponentId = $_SESSION['opponentId'];

  

?>
<body>
  <h1>対戦結果</h1>
  <div class="row">
    <div class="col-6">
      <!-- プレイヤー側 -->
      <h2>
        <?=$battle->getWinnerId() === $playerId ? 'WIN!' : 'LOSE';?>
      </h2>
      <img src="" alt="プレイヤーアイコン">
      <p><?=$gameUser->getUserName($playerId)?></p>
      <p>○勝✕敗</p>
      <p>ｘｘ位</p>
    </div>
    <div class="col-6">
      <!-- 相手側 -->
      <h2>
        <?=$battle->getWinnerId() === $opponentId ? 'WIN!' : 'LOSE';?>
      </h2>
        <img src="" alt="相手のアイコン">
        <p><?=$gameUser->getUserName($opponentId)?></p>
        <p>○勝✕敗</p>
        <p>ｘｘ位</p>
    </div>
  </div>
  <h3>ランクポイント：xxP</h3>
  <a href="./game_home.php"><button>対戦ホームへ戻る</button></a>


  <!-- BootStrap CDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
  </script>
</body>
</html>