<?php
  require_once('../DAO/User.php');
  $user = new User();
  $user->updateUserProfile($_POST);
  header('Location: ./mypage.php');
?>