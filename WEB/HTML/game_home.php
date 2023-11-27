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
<?php 
  require_once('../DAO/User.php');
  require_once('../DAO/GameUser.php');
  $user = new User();
  $user_id = $_SESSION['user_id'];
  $userName =  $user->getUserName($user_id);
  $gameUser = new GameUser();
  $opponentList = $gameUser->fetchTopPlayer(currentUser: $user_id, limit: 10);

  // $array = array();
  // $array['hihPoint'] = 100;
  // echo $array['hihPoint'];
?>
<body>
  <div class="container-fluid">
    <p>ユーザー名：<?=$userName?> {id:<?=$user_id?>}</p>
    <a href="./game_ranking.php">ランキングを見る</a>
    <hr>
    <div class="row">
      <div class="col-6">
        <h3>ステータス</h3>
        <ul>
          <li>体力：</li>
          <li>攻撃力：</li>
          <li>防御力：</li>
          <li>すばやさ：</li>
          <li>幸運：</li>
        </ul>
      </div>

      <div class="col-6">
        <h3>対戦相手を選ぶ</h3>
        <ul>
          <!-- ここに対戦相手の一覧を表示 -->
          <!-- 仮でランキング上位10人を表示 -->
            <?php foreach($opponentList as $opponent): ?>
              <li>
                <form action="./game_battle.php" method="get">
                  <input type="hidden" name="opponent_user_id" value="<?=$opponent['user_id']?>">
                  <button type="submit"><?=$opponent['nickname']?></button>
                </form>
              </li>
            <?php endforeach; ?>
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