<?php 
  session_start();
  if(isset($_SESSION['mailaddress'])){
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
  
    <label for="password">パスワード</label>
    <input type="password" name="password" id="password">
  
    <button type="submit">ログイン</button>
    
  </form>
</body>
</html>
<?php

?>