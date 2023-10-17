<?php session_start() ?>
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
  <title>タスク編集</title>
</head>
<?php
  //タスクIDがある場合は、登録済みのタスクの情報を取得して表示する
  require_once('../DAO/Task.php');
  $task = new Task();
  $task_id="";
  $taskData=array();
  $title = "";
  $detail = "";
  $period = "";
  $is_complete = false;
  $completion_time = "-";
  $last_edit_time = "-";
  $created_time = "-";

  if(isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];
    $taskData = $task->getTaskById($task_id);
    $title = $taskData['title'];
    $detail = $taskData['detail'];
    $period = date('Y-m-d', strtotime($taskData['period']));
    $is_complete = $taskData['is_complete'];
    $completion_time = $taskData['completion_time'];
    $last_edit_time = $taskData['last_edit_time'];
    $created_time = $taskData['created_time'];
  }
?>

<script>
  //確認用
  console.log(<?= json_encode($taskData) ?>)
</script>

<body>
  <form action="./task_regist.php" method="POST" id="task-edit-form"></form>
  <?php
    if(isset($_GET['task_id'])) {
      echo '<input type="hidden" value="'.$task_id.'"name="task_id" form="task-edit-form">';
    }
  ?>

  <!-- タイトル -->
  <input type="text" value="<?=$title?>" name="title"  form="task-edit-form">

  <!--期限-->
  <br><input type="date" value="<?=$period?>" name="period" form="task-edit-form"><br>

  <!-- TODO: 入力内容の保存処理 -->
  
  <!-- 完了ボタン URL以外は変更できます 。 注意！Ln63, Col83で改行するとバグります！　　↓この辺り-->
  <a href="./task_state_update.php?task_id=<?=$taskData['task_id']?>
                                        &is_complete=<?=$taskData['is_complete']?>&fromTaskEdit=true">
    <?php if($taskData['is_complete']) { ?>
      <button class="btn-success">完了</button>
    <?php } else { ?>
      <button class="btn-secondry">未完了</button>
    <?php } ?><!--end if-->
  </a>

  <p>完了日：<?=$completion_time?></p>
  <p>最終更新日:<?=$last_edit_time?></p>
  <p>作成日:<?=$created_time?></p>
  
  <!--詳細-->
  <br><textarea name="detail" autocomplete="off" form="task-edit-form"><?=$detail?></textarea>
  <br><button type="submit" form="task-edit-form">作成する</button>
  <br><button><a href="./task_list.php">キャンセル</a></button>
  <!-- BootStrap CDN-->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>