<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新規登録</title>
</head>
<body>
  <form action="signup_process.php" method="post">
    <p>名前：<input type="text" name="nickname"></p>
    <p>メールアドレス：<input type="email" name="mailaddress"></p>
    <p>パスワード：<input type="password" name="password"></p>
    <button type="submit" name="singup">新規登録</button>
  </from>
</body>
</html>