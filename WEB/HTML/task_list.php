<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>タスク一覧</title>
</head>
<?php
  require_once('../DAO/Task.php');
?>
<body>
  <h1>タスク一覧画面</h1>
  <a href="./task_edit.php?task_id=1">デバッグ用リンク：タスクID＝１</a><br>
  <button><a href="task_edit.php">タスク登録</a></button>

  <!-- タスクの一覧表示処理 -->
  <?php foreach($tasks as $taskData) :?>
    <!-- 完了ボタン -->
    <a href="./task_state_update.php?task_id<?=$taskData['task_id']?>">
      <button>完了した！</button>
    </a>
    <!-- タイトル -->
    <p><?=$taskData['title']?></p>
    <!-- 単純な実装 -->
    <a href="./task_edit.php?task_id=<?=$taskData['task_id']?>">編集する</a>
  <?php endforeach; ?>

</body>
</html>