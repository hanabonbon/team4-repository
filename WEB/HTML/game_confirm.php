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
  $user_id = $_POST['opponent_user_id']; // $user_id を設定
  require_once('../DAO/dao.php'); // Include the dao.php file
  $dao = new DAO();
  $pdo = $dao->dbConnect();
  $sql1 = "SELECT * FROM user WHERE user_id = :user_id";
  $ps1 = $pdo->prepare($sql1);
  $ps1->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $ps1->execute();
  $result1 = $ps1->fetchAll(PDO::FETCH_ASSOC);
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
    $sum = $row1['hitpoint'] + $row1['attack'] + $row1['agility'] + $row1['defence'] + $row1['luck'];
?>
<style>
  .text-size {
    font-size: 18px; /* 適切なサイズに調整してください */
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
                <img class="icon-img" src="../images/<?PHP echo $row1['icon_path'];?>" alt="アイコン画像">
              </div>
              <h3><?PHP echo $row1['nickname'];?></h3>
            </div>
            <div class="card-body">
              <h3>ステータス</h3>
              <p class="text-size">総合：<?=$sum?></p>
              <p class="text-size">攻撃力：<?=$A?></p>
              <p class="text-size">防御力：<?=$D?></p>
              <p class="text-size">すばやさ：<?=$S?></p>
              <p class="text-size">幸運：<?=$L?></p>
            </div>
          </div>
          
          <!-- 修正 -->
          <form action="game_battle.php">
            <input type="hidden" value="<?=$row1['user_id']?>">
            <button type="submit" class="btn btn-primary"  style="width: 100%;">対戦開始！</button>
          </form>
          <!-- ----------------------------------------------------------------------------------------------- -->

        </div>
      </div>
    </div><?php endforeach; ?>
    <!-- BootStrap CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
  </div>
</body>
</html>
