<?php
  require_once('../DAO/Task.php');
  $task = new Task();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/home.css?<?php echo date('YmdHis'); ?>"/>
    <title>ホーム</title>
  </head>
  <body style="background-color:#FFEED5;">
    <div class="container-fluid">
      <div class="row">
        <h1><?= $date = date("Y/m/d"); echo " " . $dayOfWeek = date("l"); ?></h1>
      </div>
        <div class="row">
          <div class="offset-10 col-2">
            <h3 class="text-center">今日の完了数</h3>
            <h3 class="text-center">3/5</h3>
          </div>
        </div>
        <div class="row">
            <h2 class="">今日のタスク</h2>
        </div>
        <div class="row">
        <?php //foreach ?>
          <div class="card task-style col-12 mx-5 my-2">
              <h6 class="text-style ml-2 mt-2">
              <input type="checkbox">
                <?= $task->getUserIdByTaskTitle(1);?>
              </h6>
          </div>
          <div class="card task-style col-12 mx-5 my-2">
              <h6 class="text-style ml-2 mt-2">
              <input type="checkbox">
                <?= $task->getUserIdByTaskTitle(1);?>
              </h6>
          </div>
        </div>
        <?php //ここまで ?>
        <div class="row">
          <div class="offset-10 col-2">
            <h3 class="text-center">順位</h3>
            <h3 class="text-center">12</h3>
          </div>
        </div>
        <h2 class="">期限が近づいています！</h2>
        <div class="row">
        <?php //foreach ?>
        <div class="card task-style col-12 mx-5 my-2">
            <h6 class="text-style ml-2 mt-2">
            <input type="checkbox">
              <?= $task->getUserIdByTaskTitle(1);?>
            </h6>
        </div>
        </div>
        <?php //ここまで ?>
        <div class="row">
          <div class="offset-10 col-2">
            <h3 class="text-center">未使用のSP</h3>
            <h3 class="text-center">3</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-12 ms-5">
            <input type="text" name="task" class="inputText-style">
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
</html>