<?php
  //タスクの完了処理
  session_start();
  require_once('../DAO/Task.php');
  $task = new Task();
  //var_dump($_GET);

  $task->updateTaskState($_GET['task_id'], !$_GET['is_complete']);

  if(isset($_GET['fromTaskEdit'])) {
    //echo 'task_edit.phpに遷移します';
    header('Location: ./task_edit.php?task_id='.$_GET['task_id']);
    exit;
  } else {
    //echo 'task_list.phpに遷移します';
    header('Location: ./task_list.php');
    exit;
  }
?>
<script>
  //デバッグ用
  console.log(<?= json_encode($_GET['task_id']) ?>)
  console.log(<?= json_encode($_GET['is_complete']) ?>)
</script>