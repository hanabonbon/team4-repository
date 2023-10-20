<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/signup.css?<?php echo date('YmdHis'); ?>"/>
  <title>新規登録</title>
</head>
<body>
  <?php
    $nickname = "";
    $mailaddress = "";
    $password = "";

    if(isset($_POST['nickname'])){
      $nickname = $_POST['nickname'];
      $mailaddress = $_POST['mailaddress'];
      $password = $_POST['password'];
    }
  ?>
  <div class="icon">
    <img src="../images/icon.png" alt="アイコン">
    </div>
  <form action="signup_validation.php" method="post">
    <div class="nickname">
    <input type="text" placeholder="ニックネーム" style="width:35%;" name="nickname" value="<?=$nickname?>"><br>
  </div>
  <div class="email">
    <input type="email" placeholder="メールアドレス" style="width:35%;" name="mailaddress" value="<?=$mailaddress?>"><br>
  </div>
  <div class="password">
    <input type="password" placeholder="パスワード" style="width:35%;" name="password" value="<?=$password?>"><br>
    </div>
    <div class="button">
    <button type="submit" name="cancel">キャンセル</button>　　　　
    <button type="submit" name="singup">確認画面へ</button>
  </div>
  </from>
</body>
</html>