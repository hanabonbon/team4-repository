<?php
  session_start();
  unset($_SESSION['opponentId']);
  unset($_SESSION['player']);
  unset($_SESSION['opponent']);
  unset($_SESSION['battle']);
  unset($_SESSION['isUpdated']);
  unset($_SESSION['message']);

  header("Location:./game_home.php");
?>