
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/home.css?<?php echo date('YmdHis'); ?>"/>
    <link rel="stylesheet" href="../CSS/menuBar.css">
    <title>ホーム</title>
  </head>
  <?php
  $user_id = 1; //セッションから取得してください
  require_once('../DAO/Task.php');
  $task = new Task();
  $tasks = $task->getAllTaskByUserId($user_id);

  //今日が期限のタスクを取得
  $todayTaskList = $task->fetchTask($user_id,
    is_complete: false, start: date('Y-m-d'), end: date('Y-m-d'));
  //今日以降のタスクを取得
  $ScheduledTaskList = $task->fetchTask($user_id,
    is_complete: false, start: date('Y-m-d', strtotime('+1 day')));
  //明日と明後日のタスクを取得
  $NearTaskList = $task->fetchTask($user_id,
    is_complete: false, start: date('Y-m-d', strtotime('+1 day')),end: date('Y-m-d', strtotime('+2 day')));
  //今日のタスク数を取得
  $TaskCount = $task->counttodayTask($user_id, date('Y-m-d'), date('Y-m-d'));
    //TODO: 今日完了したタスクの数を取得
  $completeTaskCount = $task->countCompletedTask($user_id, date('Y-m-d'), date('Y-m-d'));


  require_once('../DAO/User.php');
  $user = new User();
  //ユーザー情報を取得
  $UserskillData = $user->getUserskilpointlByUserId($user_id);
  ?>
  <script>

  </script>
  <body style="background-color:#FFEED5;">
  <div class="container-fluid">
      <div class="row">
          <!-- サイドバー -->
          <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block  text-white sidebar fixed-top">
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
    <h1 class="offset-2"><?= $date = date("Y/m/d"); echo $dayOfWeek = date("l"); ?></h1>
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
                <h2 class="offset-4  mt-5 mb-4">今日のタスク</h2>
                <div class="task-list offset-5">
                  <?php foreach($todayTaskList as $taskData) :?>
                    <div class="card task-style">
                      <h6 class="text-style ml-2 mt-2">
                      <input type="checkbox">
                      <?=$taskData['title']?>
                      </h6>
                    </div>
                  <?php endforeach; ?>
                </div>
                
                <h2 class="offset-4 mt-5  mb-4">期限が近づいています！</h2>
                <div class="task-list offset-5">
                  <?php foreach($NearTaskList as $taskData) :?>
                    <div class="card task-style">
                      <h6 class="text-style ml-2 mt-2">
                      <input type="checkbox">
                      <?=$taskData['title']?>
                      </h6>
                    </div>
                  <?php endforeach; ?>
                </div>
                <div class="insert-task  offset-4 mt-5">
                  <input type="submit"value="＋"class="insert-btn"><input type="text" class="insert-text" placeholder="タスクを追加する"><input type="button"value="＋"class="insert-btn"><lalbel class="insert-limit">期限</lalbel>
                </div>
            </div>

            <div class="col-4 text-center">
                <div class="pt-4 pb-4">
                    <p class="p-text">今日の完了数</p>
                    <div class="num-text"><span><?=$completeTaskCount?></span>/<span><?=$TaskCount?></span></div>
                </div>

                <div class="pt-4 pb-4">
                    <p class="p-text">順位</p>
                    <div class="num-text">12</div>
                </div>

                <div class="pt-4 pb-4">
                    <p class="p-text">未使用のスキルポイント</p>
                    <div class="num-text"><?=$UserskillData?></div>
                    <button class="use-btn ml-2 mt-2"onclick="location.href='mypage.php'">使う</button>
                </div>
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
</html>