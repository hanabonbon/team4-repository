<?php 
  namespace task_game;
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
    <link rel="stylesheet" href="../CSS/menuBar.css">
    <link rel="stylesheet" href="../CSS/profile.css?<?php echo date('YmdHis'); ?>"/>

    <title>登録情報の変更</title>
  </head>
  <?php
  $user_id = $_SESSION['user_id']; //セッションから取得してください
  require_once('../DAO/User.php');
  $user = new User();
  $myuser = $user->getUserDataByUserId($user_id);
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
                        <a class="nav-link" href="home.php">ホーム</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="task_list.php">タスク</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="mypage.php">マイページ</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="game_home.php">対戦</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" href="ranking.php">ランキング</a>
                    </li>
                </ul>
            </nav>
        </div>
      </div>
      <!-- メニューバーここまで -->
    <div class="container-fluid">
        <div class="row">
            <h1 class="col-12 text-center mt-5">登録情報の変更</h1>
        </div>
            <form action="change_confirm.php" enctype="multipart/form-data" method="post">
                <div class="row">
                  <div class="col-12 text-center my-5">
                    <label for="profile-icon-style" style="cursor: pointer;">
                      <img src="../images/<?= $myuser['icon_path'] ?>" class="my-icon"  id="preview">
                      <div class="plus-sign">+</div>
                    </label>
                    <input type="file" name="profile_icon" id="profile-icon-style" onchange="previewImage(this);">
                  </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <input type="text" name="nickname" class="textbox-style" value="<?= $myuser['nickname']; ?>" required>
                    </div>
                    <div class="col-12 text-center my-5">
                        <input type="email" name="mailaddress" class="textbox-style" value="<?= $myuser['mailaddress']; ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 text-end">
                      <a href="check_profile.php">
                        <button type="button" class="button-css">戻る</button>
                      </a>
                    </div>
                    <div class="col-6 text-strat">
                        <input type="submit" value="登録確認へ" class="button-css">
                    </div>
                </div>
            </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <script src="../script/image_preview.js"></script>
  </body>
</html>