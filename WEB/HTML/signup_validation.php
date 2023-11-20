<?php 
  session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/signup_validation.css?<?php echo date('YmdHis'); ?>"/>
  <title>登録内容の確認</title>
</head>
<body>
<div class="icon">
    <img src="../images/icon.png" alt="アイコン">
    </div>
  <form action="user_regist.php" method="post" id="signup-validation-form"></form>
  <input type="hidden" value="<?=$_POST['nickname']?>" form="signup-validation-form" name="nickname">

  <?php 
    //メールアドレスのバリデーションチェック
    if (!$mail = filter_var($_POST['mailaddress'], FILTER_VALIDATE_EMAIL)) {
  ?>

    <div class="error">メールドレスの形式が不正です。</div>

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

    <div class="error">パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してください。</div>

  <?php
    } else {
      echo '<input type="hidden" name="password" form="signup-validation-form" 
        value="'.$_POST['password'].'">'; 
    }

    //メールアドレス、パスワードが正しく入力されている場合のみ登録ボタンを表示
    if(preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $_POST['password']) && 
        $mail = filter_var($_POST['mailaddress'], FILTER_VALIDATE_EMAIL)) {
      echo '
      <div class="enter">
        <h3>入力内容</h3>
        <p>'.$_POST['nickname'].'</p>
        <p>'.$_POST['mailaddress'].'</p>
        <p>'.$_POST['password'].'</p>
        </div>
        <div class="button">
        <button><a href="./signup.php">戻る</a></button> 　　　
        <button><a href="./signup_complete.php">登録する</a></button>
       </div>
      ';
    }
  ?>

  <!--入力画面へ戻るフォーム-->
  <form action="signup.php" method="post">
    <input type="hidden" name="nickname" value="<?php echo $_POST['nickname']; ?>">
    <input type="hidden" name="mailaddress" value="<?php echo $_POST['mailaddress']; ?>">
    <input type="hidden" name="password" value="<?php echo $_POST['password']; ?>">
    <div class="back">
      <button><a href="./signup.php">戻る</a></button>
   </div>
  
   
  </form>

</body>
</html>