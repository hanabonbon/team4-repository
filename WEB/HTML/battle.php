<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/battle.css?<?php echo date('YmdHis'); ?>">
    <title>対戦画面</title>
  </head>
  <body style="background-color:#FFEED5;">
  <div class="container-fluid">
      <div class="row">
        <h2 class="col-6 text-center mt-3">
            <div>ユーザ名</div>
            <div>HP:<meter max="100" value="90"></meter></div>
            <hr>
        </h2>
        <h2 class="col-6 text-center mt-3">
            <div>ユーザ名</div>
            <div>HP:<meter max="110" value="50"></meter></div>
            <hr>
        </h2>
      </div>
      <div class="row">
        <div class="col-6 text-center mt-5">
            <img src="../images/default_icon.png" class="img-icon">
        </div>
        <div class="col-6 text-center mt-5">
            <img src="../images/default_icon.png" class="img-icon">
        </div>
      </div>
      <div class="row">
        <div class="col-6 mt-5 pt-5">
            <div class="card">
                <div class="log-style">
                    ユーザはスキルを使用した！
                </div>
            </div>
        </div>
        <div class="col-6 mt-5 pt-5">
            <div class="card-style">
                <a href="./battle.php">
                    <h5 class="log-style text-center mt-4">
                        攻撃
                    </h5>
                </a>
                <a href="./battle.php">
                    <h5 class="log-style text-center mt-3">
                        防御
                    </h5>
                </a>
                <a href="./battle.php">
                    <h5 class="log-style text-center mt-3">
                        回避
                    </h5>
                </a>
            </div>
        </div>
      </div>
  </div>

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