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
  <!--BootStrap Icons CDN-->
  <link rel="stylesheet" 
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../CSS/task_list.css?<?php echo date('YmdHis'); ?>">
  <link rel="stylesheet" href="../CSS/menuBar.css?<?php echo date('YmdHis'); ?>">
  <title>タスク一覧</title>
</head>
<?php
  $user_id = $_SESSION['user_id']; 
  require_once('../DAO/Task.php');
  $task = new Task();

  //今日が期限のタスクを取得
  $todayTaskList = $task->fetchTask($user_id,
    is_complete: false, start: date('Y-m-d'), end: date('Y-m-d'));
  //今日以降のタスクを取得
  $ScheduledTaskList = $task->fetchTask($user_id,
    is_complete: false, start: date('Y-m-d', strtotime('+1 day')));

  //今日完了したタスクの数を取得
  $todaysCompletedCount = 
    $task->countCompletedTask($user_id, date('Y-m-d'), date('Y-m-d'));
?>
<script>
  console.log(<?= json_encode($todayTaskList) ?>)
</script>
<body>
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
      </div>
    </nav>
  </div>
  <!-- コンテンツ -->
  <div class="container-fluid" id="task-list-contents">

    <div id="top-area"><!-- 20% -->
      <!-- <a href="./logout.php">デバッグ用ログアウト</a> -->
      <div id="button-area">
        <a href="./task_edit.php"><button>新規作成</button></a>
        <a href="./task_record.php"><button>記録を見る</button></a>
      </div>
      <h3><?=date('Y-m-d D')?> 今日のタスク</h3>
      <hr>
    </div>

    <div id="task-area"><!-- 60% -->
      <div id="today-task-area" class="container-fluid">
        <!-- 今日が期限のタスク一覧 -->
        <?php foreach($todayTaskList as $taskData) :?>
          <div class="row"><!--  align-items-center -->
            <div class="col-3 complete-button">
              <!-- 完了ボタン URL以外は変更できます-->
              <a href="./task_state_update.php?task_id=<?=$taskData['task_id']?>
                                              &is_complete=<?=$taskData['is_complete']?>">
                <?php if($taskData['is_complete']) { ?>
                  <button class="btn-secondry"><i class="bi bi-clipboard-check"></i></button>
                <?php } else { ?>
                  <button class="btn-secondry"><i class="bi bi-clipboard"></i></button>
                <?php } ?><!--end if-->
              </a>
            </div>
            <div class="col-4">
              <!-- タイトル -->
              <p><?=$taskData['title']?></p>
            </div>
            <div class="col-2">
                <p class="task-period">期限：<?=date('Y-m-d' ,strtotime($taskData['period']))?></p>
            </div>
            <div class="col-3 edit-button">
              <!-- 編集ボタン URL以外は変更できます -->
              <a href="./task_edit.php?task_id=<?=$taskData['task_id']?>">
                <button>編集する</button>
              </a>
            </div>
          </div>
          
        <?php endforeach; ?>
      </div>
  
      <h3>今後の予定</h3>
      <div id="scheduled-task-area" class="container-fluid">
        <?php foreach($ScheduledTaskList as $taskData) :?>
          <div class="row">
            <div class="col-3 complete-button">
              <!-- 完了ボタン URL以外は変更できます-->
              <a href="./task_state_update.php?task_id=<?=$taskData['task_id']?>
                                              &is_complete=<?=$taskData['is_complete']?>">
                <?php if($taskData['is_complete']) { ?>
                  <button class="btn-secondry"><i class="bi bi-clipboard-check"></i></button>
                <?php } else { ?>
                  <button class="btn-secondry"><i class="bi bi-clipboard"></i></button>
                <?php } ?><!--end if-->
              </a>
            </div>
            <div class="col-4">
              <!-- タイトル -->
              <p class="task-title"><?=$taskData['title']?></p>
            </div>
            <div class="col-2">
                <p class=" task-period">期限：<?=date('Y-m-d' ,strtotime($taskData['period']))?></p>
            </div>
            <div class="col-3 edit-button">
              <!-- 編集ボタン URL以外は変更できます -->
              <a href="./task_edit.php?task_id=<?=$taskData['task_id']?>">
                <button>編集する</button>
              </a>
            </div>
          </div>
          
        <?php endforeach; ?>
      </div>
    </div>
      
    <p id="task-message">今日は<?=$todaysCompletedCount?>件のタスクを完了しました。</p>
    
    <div id="quick-task-area">
      <!-- 簡易タスク追加 -->
      <div class="row">
        <div class="col-4">
          <input type="text" name="title" form="quick-task-add">
        </div>
        <div class="col-3">
          <input type="date" name="period" required="required" form="quick-task-add">
        </div>
        <div class="col-1">
          <button type="submit" form="quick-task-add">追加</button>
        </div> 
        <form action="./task_regist.php" method="post" id="quick-task-add"></form>
      </div>
    </div>

  </div><!-- task-list-contents -->
  
  <!-- BootStrap CDN-->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>