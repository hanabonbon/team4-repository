<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--BootStrap CDN-->
  <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
  />
  <!--BootStrap Icons CDN-->
  <link rel="stylesheet" 
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <title>タスク一覧</title>
</head>
<?php
  $user_id = 1; //セッションから取得してください
  require_once('../DAO/Task.php');
  $task = new Task();
  $tasks = $task->getAllTaskByUserId($user_id);
?>
<script>
  console.log(<?= json_encode($tasks) ?>)
</script>
<body>
  <h1>タスク一覧画面</h1>
  <!-- <a href="./task_edit.php?task_id=1">デバッグ用リンク：タスクID＝１</a><br> -->
  <button><a href="task_edit.php">新規作成</a></button><br>
  <hr>

  <!-- タスクの一覧表示処理 -->
  <?php foreach($tasks as $taskData) :?>
    <div class="row">
      <div class="col-3">
        <!-- 完了ボタン URL以外は変更できます-->
        <a href="./task_state_update.php?task_id=<?=$taskData['task_id']?>
                                        &is_complete=<?=$taskData['is_complete']?>">
          <?php if($taskData['is_complete']) { ?>
            <button class="btn-secondry"><i class="bi bi-clipboard-check"></i></button>
          <?php } else { ?>
            <button class="btn-secondry"><i class="bi bi-clipboard"></i></button>
          <?php } ?><!--end if-->
        </a>
      </div>
      <div class="col-6">
        <!-- タイトル -->
        <p><?=$taskData['title']?></p>
      </div>
      <div class="col-3">
        <!-- 編集ボタン URL以外は変更できます -->
        <a href="./task_edit.php?task_id=<?=$taskData['task_id']?>">
          <button>編集する</button>
        </a>
      </div>
    </div>
    <hr>
  <?php endforeach; ?>

  <!-- BootStrap CDN-->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>