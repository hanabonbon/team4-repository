<?php 
  //セッション変数'battle'を削除
  session_start();
  unset($_SESSION['battle']);
  header('location: ./game_battle.php');
?>