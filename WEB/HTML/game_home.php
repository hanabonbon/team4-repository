<?php
  namespace task_game;
  use DAO;
  use PDO;
  session_start();
  if(!isset($_SESSION['user_id'])){
    header('location: ./login.php');
  }
  unset($_SESSION['opponentId']);
  unset($_SESSION['player']);
  unset($_SESSION['opponent']);
  unset($_SESSION['battle']);
  unset($_SESSION['isUpdated']);
  unset($_SESSION['message']);
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
  $user_id = $_SESSION['user_id']; // $user_id を設定
  require_once('../DAO/dao.php'); // Include the dao.php file
  $dao = new DAO();
  $pdo = $dao->dbConnect();
  $sql1 = "SELECT * FROM user WHERE user_id = :user_id";
  $sql2 = "SELECT * FROM user WHERE user_id NOT IN(:user_id) ORDER BY ABS(rank_point - (SELECT rank_point FROM user WHERE user_id = :user_id)) ASC, user_id ASC LIMIT 4";
  $ps1 = $pdo->prepare($sql1);
  $ps2 = $pdo->prepare($sql2);
  $ps1->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $ps2->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $ps1->execute();
  $ps2->execute();
  $result1 = $ps1->fetchAll(PDO::FETCH_ASSOC);
  $result2 = $ps2->fetchAll(PDO::FETCH_ASSOC);
  foreach ($result1 as $row1):
    $P = $row1['skill_point'];
    $sp = $P;
    $H = 100;
    for ($i = 1; $i < $row1['hitpoint']; $i++) {
      $H += 5;
    }
    $A = 20;
    for ($i = 1; $i < $row1['attack']; $i++) {
      $A += 1;
    }
    $S = 10;
    for ($i = 1; $i < $row1['agility']; $i++) {
      if($i <= 50){
        $S += 0.4;
      }elseif($i <= 100){
        $S += 0.8;
      }else{
        $S += 0.1;
      }
    }
    $D = 5;
    for($i = 1;$i < $row1['defence'];$i++){
      if($i <= 50){
        $D += 0.4;
      }elseif($i <= 100){
        $D += 0.5;
      }else{
        $D += 0.1;
      }
    }
    $L = 0.6;
    for($i = 1;$i < $row1['luck'];$i++){
      if($i <= 50){
        $L += 0.6;
      }elseif($i <= 100){
        $L += 0.4;
      }else{
        $L += 0.1;
      }
    }
?>
<style>
  /* すべてのカードのボーダーを茶色に設定 */
  .card {
    border: 2px solid #8B4513; /* 茶色のボーダー */
  }
</style>
<body>
  <header>
    <a href="home.php">←ホームへ</a>
    <a href="ranking.php">ランキングを見る→</a>
  </header>
  <div class="container">
    <div class="container-fluid">
      <div class="py-5 text-center">
        <h2>対戦相手を選んでください</h2>
      </div>
      <div class="row">
        <div class="col-5 text-center">
          <div class="card mb-4 rounded-3 shadow-sm color">
            <div class="card-header">
              <div class="circle-icon">
                <img class="icon-img" src="../images/<?PHP echo $row1['icon_path'];?>" alt="アイコン画像">
              </div>
              <h3><?PHP echo $row1['nickname'];?></h3>
            </div>
            <div class="card-body">
              <h3>ステータス</h3>
              <p>攻撃力：<?=$A?></p>
              <p>防御力：<?=$D?></p>
              <p>すばやさ：<?=$S?></p>
              <p>幸運：<?=$L?></p>
              <form action="./game_battle.php" method="post">
                <input type="hidden" name="myhistory" value="<?=$row1['user_id']?>">
                <button type="submit">戦歴を見る</button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-7">
          <div class="card mb-4 rounded-3 shadow-sm color">
            <div class="card-header text-center">
              <h3>対戦相手一覧</h3>
            </div>
            <!-- ここに対戦相手の一覧を表示 -->
            <!-- 仮でランキング上位10人を表示 -->
            <?php foreach ($result2 as $row2): ?>
            <?php $sum = $row2['hitpoint'] + $row2['attack'] + $row2['agility'] + $row2['defence'] + $row2['luck']; ?> 
            <li class="list-group-item lh-sm color d-flex justify-content-between">
              <form action="./game_confirm.php" method="post" class="d-flex align-items-center">
                <div class="circle-icon-mini">
                  <img class="icon-img" src="../images/<?php echo $row2['icon_path']?>" alt="アイコン画像">
                </div>
                <input type="hidden" name="opponent_user_id" value="<?=$row2['user_id']?>">
                <button type="submit"><?=$row2['nickname']?></button>
                <p class="m-0 ms-2">想定パワー：<?php echo $sum;?></p>
              </form>
              <form action="./game_battle.php" name="yourhistory" method="post" class="ml-auto d-flex">
                <input type="hidden" value="<?=$row2['user_id']?>">
                <button type="submit">戦歴を見る</button>
              </form>
            </li>
            <?php endforeach; ?>
            <?php endforeach; ?>
          </div>
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
