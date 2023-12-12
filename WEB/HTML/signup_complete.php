<?php 
  namespace task_game;
  session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/signup_complete.css?<?php echo date('YmdHis'); ?>"/>
  <title>登録完了</title>
</head>
<body>
<div class="icon">
    <img src="../images/icon.png" alt="アイコン">
    </div>
    <h2>登録完了</h2><br>
<div class="text">

  <p>登録が完了しました。</p><br><br>
  <a href="./login.php">ログインする</a>
</div>
</body>
</html>