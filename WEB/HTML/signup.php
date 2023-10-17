<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  <form action="signup_validation.php" method="post">
    <p>ニックネーム：<input type="text" name="nickname" value="<?=$nickname?>"></p>
    <p>メールアドレス：<input type="email" name="mailaddress" value="<?=$mailaddress?>"></p>
    <p>パスワード：<input type="password" name="password" value="<?=$password?>"></p>
    <button type="submit" name="singup">新規登録</button>
  </from>
</body>
</html>