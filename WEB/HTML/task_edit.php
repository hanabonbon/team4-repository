<?php 
  namespace task_game;
  session_start();
  if(!isset($_SESSION['user_id'])){
    header('location: ./login.php');
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--BootStrap CDN-->
  <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
  />
  <link rel="stylesheet" href="../CSS/menuBar.css">
  <link rel="stylesheet" href="../css/task_edit.css?<?php echo date('YmdHis'); ?>"/>
  <title>タスク編集</title>
</head>
<?php
  $user_id = $_SESSION['user_id']; //セッションから取得してください
  require_once('../DAO/User.php');
  $user = new User();
  $myuser = $user->getUserDataByUserId($user_id);
  //タスクIDがある場合は、登録済みのタスクの情報を取得して表示する
  require_once('../DAO/Task.php');
  $task = new Task();
  $task_id="";
  $taskData=array();
  $title = "";
  $detail = "";
  $period = "";
  $is_complete = false;
  $completion_time = "-";
  $last_edit_time = "-";
  $created_time = "-";

  if(isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];
    $taskData = $task->getTaskById($task_id);
    $title = $taskData['title'];
    $detail = $taskData['detail'];
    $period = date('Y-m-d', strtotime($taskData['period']));
    $is_complete = $taskData['is_complete'];
    $completion_time = $taskData['completion_time'];
    $last_edit_time = $taskData['last_edit_time'];
    $created_time = $taskData['created_time'];
  }
?>

<script>
  //確認用
  console.log(<?= json_encode($taskData) ?>)
</script>

<body>
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
  <div class="card card-style float-end me-3">
  <div class="row">
  <div id="app">
  <form action="./task_regist.php" method="POST" id="task-edit-form"></form>
  <?php
    if(isset($_GET['task_id'])) {
      echo '<input type="hidden" value="'.$task_id.'"name="task_id" form="task-edit-form">';
    }
  ?>

  <!-- TODO: 入力内容の保存処理 -->
  <!-- タスク完了の入力 -->
  <div class="text-end mx-3 my-3">
  <select name="is_complete" form="task-edit-form">
    <option value="1" <?= $is_complete ? "selected": "" ?>>完了済み</option>
    <option value="0" <?= $is_complete ? "": "selected" ?>>未完了</option>
  </select>
  </div>


  <div class="text-center mt-3">
  <!-- タイトル -->
  <input type="text" value="<?=$title?>" name="title" form="task-edit-form" placeholder="タイトルを入力" style="background-color: inherit; border: none; width: 100%; text-align: center;">

</div>

  <div class="ms-5">
  <!--期限-->
  <br><input type="date" value="<?=$period?>" name="period"  required="required" form="task-edit-form">
  </div>
  
  <div class="ms-5 mt-3" style="font-size: 11px;">
  <p>完了日：<span style="font-size: 13.5px;"><?=$completion_time?></span></p>
  <p>最終更新日：<span style="font-size: 13.5px;"><?=$last_edit_time?></span></p>
  <p>作成日：<span style="font-size: 13.5px;"><?=$created_time?></span></p>
</div>
  <hr>
  <div class="text-center">
  <!--詳細-->
  <textarea name="detail" placeholder="詳細を入力" autocomplete="off" form="task-edit-form" style="width: 100%; min-height: 130px; background-color: inherit; border: none;"><?=$detail?></textarea>
  </div>
  <hr>
  <div class="button">
  <br><button onclick="history.back()">キャンセル</button>　　　　　　　　　　　
  <button type="submit" form="task-edit-form">作成する</button>
  </div>
  </div>
  </div>
  </div>

  <!-- Vue.js CDN -->
  <!-- BootStrap CDN-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>