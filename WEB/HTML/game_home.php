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
  $user = new User();
  $user_id = $_SESSION['user_id'];
  $userName =  $user->getUserName($user_id);
?>
<body>
  <div class="container-fluid">
    <p>ユーザー名：<?=$userName?></p>
    <a href="./game_ranking.php">ランキングを見る</a>
    <hr>
    <div class="row">
      <div class="col-6">
        <h3>ステータス</h3>
      </div>
      <div class="col-6">
        <h3>対戦相手を選ぶ</h3>
      </div>
    </div>












  </div>
  <!-- BootStrap CDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
  </script>
</body>
</html>