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
  <link rel="stylesheet" href="../CSS/task_list.css">
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
  <a href="./logout.php">デバッグ用ログアウト</a><br>
  <h1>タスク一覧画面</h1>
  <a href="./task_edit.php"><button>新規作成</button></a>
  <a href="./task_record.php"><button>記録を見る</button></a>
  <h3><?=date('Y-m-d D')?> 今日のタスク</h3>
  <hr>
  <!-- 今日が期限のタスク一覧 -->
  <?php foreach($todayTaskList as $taskData) :?>
    <div class="row">
      <div class="col-3">
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
          <p>期限：<?=date('Y-m-d' ,strtotime($taskData['period']))?></p>
      </div>
      <div class="col-3">
        <!-- 編集ボタン URL以外は変更できます -->
        <a href="./task_edit.php?task_id=<?=$taskData['task_id']?>">
          <button>編集する</button>
        </a>
      </div>
    </div>
    <hr>
  <?php endforeach; ?>
  
  <h3>今後の予定</h3>
  <?php foreach($ScheduledTaskList as $taskData) :?>
    <div class="row">
      <div class="col-3">
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
          <p>期限：<?=date('Y-m-d' ,strtotime($taskData['period']))?></p>
      </div>
      <div class="col-3">
        <!-- 編集ボタン URL以外は変更できます -->
        <a href="./task_edit.php?task_id=<?=$taskData['task_id']?>">
          <button>編集する</button>
        </a>
      </div>
    </div>
    <hr>
  <?php endforeach; ?>

  <p>今日は<?=$todaysCompletedCount?>件のタスクを完了しました。</p>

  <!-- 簡易タスク追加 -->
  <form action="./task_regist.php" method="post" id="quick-task-add"></form>
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
  </div>
  
  <!-- BootStrap CDN-->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>