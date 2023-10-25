<?php
  session_start();
  if(!isset($_SESSION['user_id'])){
    header('location: ./login.php');
  }
  require_once('../DAO/Task.php');
  $task = new Task();
  $user_id = $_SESSION['user_id']; 

  //task_idの有無で新規登録or更新を判断する  

  if(isset($_POST['task_id'])) {
    $task -> updateTask($_POST);
    header('Location: ./task_list.php');
    exit;
  }
  $task -> insertTask($user_id, $_POST);
  header('Location: ./task_list.php');
?>