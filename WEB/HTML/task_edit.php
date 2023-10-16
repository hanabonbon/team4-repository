<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>タスク編集</title>
</head>
<?php
  //タスクIDがある場合は、登録済みのタスクの情報を取得して表示する
  $task_id;
  $taskData=array();
  $title;
  $detail;
  $period;
  $is_Complete;
  if(isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];
    //IDからタスクの情報を取得する
    //getTaskDataById(task_id);
    //$taskData = getTaskDataById($task_id);
  }
?>
<body>
  <form action="task_regist" method="POST" id="task-edit-form"></form>

  <!-- タスクIDが空の場合は新規タスクのため、IDは送信しない -->
  <input type="hidden" value="<?=$task_id?>" name="task_id" form="task-edit-form">

  <input type="text" value="<?=$title?>" name="title"  form="task-edit-form">
  <input type="date" value="<?=$period?>" name="period" form="task-edit-form">
  <!-- DBから取得、又は現在日時 -->
  <p>最終更新日</p>
  <!-- DBから取得、又は現在日時 -->
  <p>作成日</p>
  <input type="checkbox" value="<?=$is_Complete?>" name="is_Complete" form="task-edit-form">
  <textarea name="detail" autocomplete="off" form="task-edit-form"><?=$detail?></textarea>
  <button type="submit" form="task-edit-form">作成する</button>
  <button><a href="./task_list.php">キャンセル</a></button>
</body>
</html>