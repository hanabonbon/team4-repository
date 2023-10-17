<?php
  require_once('../DAO/Task.php');
  $task = new Task();
  $user_id = 1; //セッションから取得する

  //task_idの有無で新規登録か更新かを判断する  

  if(isset($_POST['task_id'])) {
    $task -> updateTask($_POST);
    header('Location: ./task_list.php');
    exit;
  }
  $task -> insertTask($user_id, $_POST);
  header('Location: ./task_list.php');
?>