<!DOCTYPE html>
<html lang="jp">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン</title>
</head>
<body>
  <form action="./login_check.php">
    <div>
      <label for="user_id">ユーザーID</label>
      <input type="text" name="user_id" id="user_id">
    </div>
    <div>
      <label for="password">パスワード</label>
      <input type="password" name="password" id="password">
    </div>
    <div>
      <input type="submit" value="ログイン">
    </div>
  </form>
</body>
</html>
<?php

?>