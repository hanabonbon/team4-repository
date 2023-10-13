<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>登録内容の確認</title>
</head>
<body>
  <form action="user_regist.php" method="post" id="singnup-validation-form"></form>
  <?php 
    //メールアドレスのバリデーションチェック
    if (!$mail = filter_var($_POST['mailaddress'], FILTER_VALIDATE_EMAIL)) {
  ?>

    <p>メールドレスの形式が不正です。</p>

  <?php 
    } else {
      echo '<input type="hidden" name="mailaddress" form="signup-validation-form"
        value="'.$_POST['mailaddress'].'">';
    } 
  ?>

  <?php 
    //パスワードのバリデーションチェック
    if (!preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $_POST['password'])) {    
  ?>

    <p>パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してください。</p>

  <?php
    } else {
      echo '<input type="hidden" name="password" form="signup-validation-form" 
        value="'.$_POST['password'].'">'; 
    }

    //メールアドレス、パスワードが正しく入力されている場合のみ登録ボタンを表示
    if(!preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $_POST['password']) && 
        !$mail = filter_var($_POST['mailaddress'], FILTER_VALIDATE_EMAIL)) 
  ?>

  <button type="submit" form="signup-validation-form">登録する</button>

  <!--入力画面へ戻るフォーム-->
  <form action="signup.php" method="post">
    <input type="hidden" name="nickname" value="<?php echo $_POST['nickname']; ?>">
    <input type="hidden" name="mailaddress" value="<?php echo $_POST['mailaddress']; ?>">
    <input type="hidden" name="password" value="<?php echo $_POST['password']; ?>">
    <button type="submit">戻る</button>
  </form>

</body>
</html>