<?php
  namespace task_game;
  //use task_game\EnumActionState;
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

  <!--BootStrap CDN-->
  <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
  />
  <link rel="stylesheet" href="../CSS/game_home.css?<?php echo date('YmdHis'); ?>">
  <title>ゲーム</title>
</head>
<style>
  .text-size {
    font-size: 16px; /* 適切なサイズに調整してください */
  }
  /* すべてのカードのボーダーを茶色に設定 */
  .card {
    border: 2px solid #8B4513; /* 茶色のボーダー */
  }
</style>
<body>
  <header>
    <a href="game_home.php">←選択画面に戻る</a>
  </header>
  <div class="container" style="max-width: 600px;">
    <div class="container-fluid">
      <div class="py-5 text-center">
        <h2>対戦を開始しますか？</h2>
      </div>
      <div class="row">
        <div class="text-center">
          <div class="card mb-4 rounded-3 shadow-sm color">
            <div class="card-header">
              <div class="circle-icon">
                <img class="icon-img" src="../images/<?=$gameUser->fetchIconPath($opponentId)?>" alt="アイコン画像">
              </div>
              <h3><?=$opponentName?></h3>
            </div>
            <div class="card-body">
              <h3>ステータス</h3>
<<<<<<< HEAD
              <p class="text-size">総合：<?=$sum?></p>
              <p class="text-size">体力：<?=$H?></p>
              <p class="text-size">攻撃力：<?=$A?></p>
              <p class="text-size">防御力：<?=$D?></p>
              <p class="text-size">すばやさ：<?=$S?></p>
              <p class="text-size">幸運：<?=$L?></p>
=======
              <p class="text-size">総合：<?=$gameUser->fetchLevel($opponentId)?></p>
              <p class="text-size">攻撃力：<?=$opponent->getATK()?></p>
              <p class="text-size">防御力：<?=$opponent->getDEF()?></p>
              <p class="text-size">すばやさ：<?=$opponent->getAGL()?></p>
              <p class="text-size">幸運：<?=$opponent->getLUK()?></p>
>>>>>>> main
            </div>
          </div>

          <a href="./game_battle.php"><button>対戦する</button></a>

        </div>
      </div>
    </div>
    <!-- BootStrap CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
  </div>
</body>
</html>
