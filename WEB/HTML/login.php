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
  <link rel="stylesheet" href="../CSS/login.css?<?php echo date('YmdHis'); ?>"/>
  <title>ログイン</title>
</head>
<body>
<div class="icon">
    <img src="../images/icon.png" alt="アイコン">
    </div>
  <form action="./login_check.php" method="post">
    
    <label for=""></label>
    <input type="text" placeholder="メールアドレス" name="mailaddress" id="mailaddress">
    <br>
    <label for="password"></label>
    <input type="password" placeholder="パスワード" name="password" id="password">
    <br>
    <button type="submit">ログイン</button>
    
  </form>
    <button><a href="./signup.php">新規登録はこちら</a></button>
</body>
</html>
<?php

?>