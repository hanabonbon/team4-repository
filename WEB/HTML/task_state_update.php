<?php
  namespace task_game;

  //タスクの完了処理
  session_start();
  if(!isset($_SESSION['user_id'])){
    header('location: ./login.php');
  }
  require_once('../DAO/Task.php');
  require_once('../DAO/Test.php');
  $task = new Task();
  $test = new Test();
  //var_dump($_GET);
  $spData = $test->getSpByUserId($_SESSION['user_id']);
  $sp = $spData['skill_point'] + 1;
  $test->updateSkillPoint($sp,$_SESSION['user_id']);
  $task->updateTaskState($_GET['task_id'], !$_GET['is_complete']);
  //前のページに戻る
  header("Location:".$_SERVER['HTTP_REFERER']);
  exit;
?>
<script>
  //デバッグ用
  console.log(<?= json_encode($_GET['task_id']) ?>)
  console.log(<?= json_encode($_GET['is_complete']) ?>)
</script>