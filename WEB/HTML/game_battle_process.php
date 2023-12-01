<?php 
  session_start();
  if(!isset($_SESSION['user_id'])){
    header('location: ./login.php');
  }

  include('../game/BattleController.php');

  $battle = unserialize($_SESSION['battle']);

  if(isset($_POST['attack'])) {
    $battle->attack($_SESSION['user_id']);
    $_SESSION['battle'] = serialize($battle);
  }

  header("Location:".$_SERVER['HTTP_REFERER']);

?>
