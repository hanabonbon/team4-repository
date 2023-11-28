<?php 
  session_start();
  if(!isset($_SESSION['user_id'])){
    header('location: ./login.php');
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/menuBar.css?<?php echo date('YmdHis'); ?>">
    <link rel="stylesheet" href="../CSS/ranking.css?<?php echo date('YmdHis'); ?>">
    <!-- フォントのインポート -->
    <style>@import url('https://fonts.googleapis.com/css2?family=DotGothic16&family=Hachi+Maru+Pop&family=Train+One&display=swap');</style>
    <title>ranking</title>
  </head>
  <?php
  $user_id = $_SESSION['user_id']; //セッションから取得してください
  require_once('../DAO/User.php');
  $user = new User();
  $myuser = $user->getUserDataByUserId($user_id);
  require_once('../DAO/Test.php');
  $test = new Test();
  $rank = $test->selectAllRanking();
  ?>
  <body style="background-color:#FFEED5;">
  <div class="container-fluid">
        <div class="row">
            <!-- サイドバー -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block  text-white sidebar  fixed-top">
              <div class="position-sticky">
                  <ul class="nav flex-column">
                    <!--アイコンとユーザー名-->
                    <div class="icon-name">
                      <div class="img-area">
                        <img src="../images/<?= $myuser['icon_path'] ?>" class="img-icon">
                      </div>
                      <div class="name-area">
                        <label class="username-area"><?= $myuser['nickname'] ?></label>
                      </div>
                    </div>
  
                      <li class="nav-item active">
                        <!-- タスク上の白線 -->
                        <div class="nav-link"></div>
                          <a class="nav-link" href="task_list.php">タスク</a>
                      </li>
  
                      <li class="nav-item">
                          <a class="nav-link" href="mypage.php">マイページ</a>
                      </li>
  
                      <li class="nav-item">
                          <a class="nav-link" href="battle.html">対戦</a>
                      </li>
  
                      <li class="nav-item">
                        <a class="nav-link" href="ranking.php">ランキング</a>
                      </li>
                  </ul>
          </nav>
        </div>
      </div>
      <!-- メニューバーここまで -->
    <h2 class="text-center mt-5">ランキング</h2>
    <h5 class="text-center mt-3">現在の順位：<?php $test->selectMyRanking($_SESSION['user_id']) ?>位</h5>
    <?php foreach($rank as $index => $row) : ?>

    <div class="ranking_area text-center">
      <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mb-2 <?= ($index === 0) ? 'top-rank-1' : (($index === 1) ? 'top-rank-2' : (($index === 2) ? 'top-rank-3' : '')) ?>">
                <div class="card-body text-color">
                  <span class="text-start"><h6><?= $test->selectMyRanking($row['user_id']) . "位" ?></h6></span>
                  <span><img src="../images/<?= $row['icon_path'] ?>" class="img-icon"><h5><?= $row['nickname']; ?></h5></span>
                  <span class="text-end"><h6><?= $row['rank_point']; echo "RP"; ?></h6></span>
                </div>
            </div>
        </div>
    </div>

    <?php endforeach; ?>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html