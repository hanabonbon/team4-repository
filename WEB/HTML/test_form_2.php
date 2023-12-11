<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>フォーム２</title>
</head>
<body>
  <?php
    if(isset($_GET['attack'])) {
      echo '攻撃しました';
    } elseif(isset($_GET['defence'])) {
      echo '防御しました';
    } elseif(isset($_GET['avoid'])) {
      echo '回避しました';
    } else {
      echo '何もしませんでした';
    }
  ?>
</body>
</html>