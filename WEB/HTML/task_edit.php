<?php session_start() ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>タスク編集</title>
</head>
<?php
  //タスクIDがある場合は、登録済みのタスクの情報を取得して表示する
  //完了ボタンを押した瞬間の時間を登録する必要がある
  //is_complete, completion_timeは別処理で更新する

  require_once('../DAO/Task.php');
  $task = new Task();
  $task_id="";
  $taskData=array();
  $title = "";
  $detail = "";
  $period = "";
  $is_complete = false;
  $last_edit_time = "-";
  $created_time = "-";

  if(isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];
    $taskData = $task->getTaskById($task_id);
    $title = $taskData['title'];
    $detail = $taskData['detail'];
    $period = date('Y-m-d', strtotime($taskData['period']));
    $is_complete = $taskData['is_complete'];
    $last_edit_time = $taskData['last_edit_time'];
    $created_time = $taskData['created_time'];
  }

  //コンソールでの確認用
  echo '<script> console.log(' . json_encode($taskData) . ') </script>';
?>

<body>
  <form action="./task_regist.php" method="POST" id="task-edit-form"></form>
  <?php
    if(isset($_GET['task_id'])) {
      echo '<h1>タスク編集</h1>';
      echo '<input type="hidden" value="'.$task_id.'"name="task_id" form="task-edit-form">';
    } else {
      echo "<h1>タスク登録</h1>";
    }
  ?>

  <!-- タイトル -->
  <input type="text" value="<?=$title?>" name="title"  form="task-edit-form">
  <!--期限-->
  <br><input type="date" value="<?=$period?>" name="period" form="task-edit-form">
  <p>最終更新日:<?=$last_edit_time?></p>
  <p>作成日:<?=$created_time?></p>
  <!--完了状況-->

  <?php
     //TODO: 完了の送信ボタンを押した場合は、完了状況を更新する
  ?>
  
  <!--詳細-->
  <br><textarea name="detail" autocomplete="off" form="task-edit-form"><?=$detail?></textarea>
  <br><button type="submit" form="task-edit-form">作成する</button>
  <br><button><a href="./task_list.php">キャンセル</a></button>
</body>
</html>