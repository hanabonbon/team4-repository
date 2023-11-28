<?php
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
  
  //自分
  $user_id = $_SESSION['user_id'];
  $userName =  $gameUser->getUserName($user_id);
  $userStatusLv = $gameUser->fetchUserStatusLv($user_id);

  $player = new Player($userStatusLv);

  //相手
  $opponentId = $_GET['opponent_user_id'];
  $opponentName =  $gameUser->getUserName($opponentId);
  $opponentStatusLv = $gameUser->fetchUserStatusLv($opponentId);

  $opponent = new Player($opponentStatusLv);


  

























  
?>
<body>
  <div class="container-fluid">
    <h1>対戦画面</h1>
    <!-- 2人のデータをもとに、インスタンスを作る -->
    <div class="row">
      <div class="col-6">
        <h3>あなた：<?=$userName?> {id:<?=$user_id?>}</h3>
        <ul>
          <li>体力：<?=$player->getHihPoint()?></li>
          <li>攻撃力：<?=$player->getAttack()?></li>
          <li>防御力：<?=$player->getdefence() * 100?>%</li>
          <li>すばやさ：<?=$player->getAgility() * 100?>%</li>
          <li>幸運：<?=$player->getluck() * 100?>%</li>
        </ul>
      </div>
      <div class="col-6">
        <h3>相手：<?=$opponentName?> {id:<?=$opponentId?>}</h3>
        <ul>
          <li>体力：<?=$opponent->getHihPoint()?></li>
          <li>攻撃力：<?=$opponent->getAttack()?></li>
          <li>防御力：<?=$opponent->getdefence() * 100?>%</li>
          <li>すばやさ：<?=$opponent->getAgility() * 100?>%</li>
          <li>幸運：<?=$opponent->getluck() * 100?>%</li>
        </ul>
      </div>
    </div>


  </div>
  <!-- BootStrap CDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
  </script>
</body>
</html>