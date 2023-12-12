<?php 
  namespace task_game;
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../CSS/login.css?<?php echo date('YmdHis'); ?>"/>
  <title>ログイン</title>
</head>
<body>
<div class="icon">
    <img src="../images/icon.png" alt="アイコン">
    </div>

  <form action="./login_check.php" method="post">

 <div class="textbox">
    <input type="text"  placeholder="メールアドレス" style="width:35%;" name="mailaddress" >
   <br><br>
    <input type="password" placeholder="パスワード" style="width:35%;" name="password" id="password">
    <br>
</div>
<div class="button">
    <button type="submit">ログイン</button>
    <br>
    <br>
  </form>
    <button><a href="./signup.php">新規登録はこちら</a></button>
    <br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
<?php

?>