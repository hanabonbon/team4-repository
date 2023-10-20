<?php 
  session_start();
  if(isset($_SESSION['user_id'])){
    header('location: ./task_list.php');
  }
?>
<!DOCTYPE html>
<html lang="jp">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン</title>
</head>
<body>

  <form action="./login_check.php" method="post">
    
    <label for="">メールアドレス</label>
    <input type="text" name="mailaddress" id="mailaddress">
    <br>
    <label for="password">パスワード</label>
    <input type="password" name="password" id="password">
    <br>
    <button type="submit">ログイン</button>
    
  </form>
  <a href="./signup.php">新規登録はこちら</a>
</body>
</html>
<?php

?>