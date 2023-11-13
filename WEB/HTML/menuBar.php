<!doctype html>
<html lang="ja">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../CSS/menuBar.css">
  <title>メニューバー</title>
</head>

<body>

  <!-- 
    このファイルはメニューバーのテンプレートです。
    BootStrapを導入し、'CSS/menuBar.css'を読み込んでください。
    各画面のCSSでメニューバーを除いたコンテンツ全体に
      width: 85%;
      margin-left: 15%;
    を指定してください。
  -->

  <!-- コピペここから -->
  <div class="container-fluid">
    <div class="row">
      <!-- サイドバー -->
      <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block  text-white sidebar  fixed-top">
        <div class="position-sticky">
          <ul class="nav flex-column">
            <!--アイコンとユーザー名-->
            <div class="icon-name">
              <div class="img-area">
                <img src="../images/default_icon.png" class="img-icon">
              </div>
              <div class="name-area">
                <label class="username-area">〇〇〇〇</label>
              </div>
            </div>

            <li class="nav-item active">
              <!-- タスク上の白線 -->
              <div class="nav-link"></div>
              <a class="nav-link" href="task.html">タスク</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="mypage.html">マイページ</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="battle.html">対戦</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="ranking.html">ランキング</a>
            </li>
          </ul>
      </nav>
    </div>
  </div>
  <!-- コピペここまで -->

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>