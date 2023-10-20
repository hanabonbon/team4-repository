<?php
  session_start();
  if(isset($_SESSION['mailaddress'])){
    header('location: ./task_list.php');
  }
  require_once('../DAO/User.php');
  $user = new User();
  $user->registUser($_POST);
  header('Location: ./signup_complete.php');
?>