<?php
  session_start();
  session_destroy();
  echo '<p>ログアウトしました</p>';
  echo '<a href="./login.php">ログイン画面へ</a>';
?>