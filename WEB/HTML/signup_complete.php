<?php 
  session_start();
  if(isset($_SESSION['mailaddress'])){
    header('location: ./task_list.php');
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>登録完了</title>
</head>
<body>
  <h2>登録完了</h2>
  <p>登録が完了しました。</p>
  <a href="/login.php">ログインする</a>
</body>
</html>