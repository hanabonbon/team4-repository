<?php 
  session_start(); 
  if(!isset($_SESSION['user_id'])){
    header('location: ./login.php');
  }
?>
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
  <title>タスクの記録</title>
</head>
<?php
  $user_id = $_SESSION['user_id']; 
  require_once('../DAO/Task.php');
  $task = new Task();
  $is_complete;
  $taskHistory = array();

  //ソートの条件確認
  if(isset($_GET['is_complete'])) {
    $is_complete = $_GET['is_complete'];
  } else {
    $is_complete = 2;
  }

  //タスクがあった月を取得
  $month = $task->fetchMonth($user_id, end: date('Y-m-d'));

  //今日までに完了したタスク数を取得
  $completedCount = 
    $task->countCompletedTask($user_id, end: date('Y-m-d'));
  //今月完了したタスク数を取得
  $thisMonthCompletedCount = 
    $task->countCompletedTask($user_id, start: date('Y-m-01'), end: date('Y-m-t'));
  //先月完了したタスク数を取得
  $lastMonthCompletedCount = 
    $task->countCompletedTask($user_id, start: date('Y-m-01', strtotime('-1 month')), 
      end: date('Y-m-t', strtotime('-1 month')));
  //1ヶ月の平均完了数
  $average = $task->averageCompletedCountByMonth($user_id);
?>

<body>
  <a href="./task_list.php"><button>戻る</button></a>
  <h3>完了したタスク</h3>

  <p>今日までに完了したタスク数:<?=$completedCount?></p>
  <p>今月のタスク完了数:<?=$thisMonthCompletedCount?></p>
  <p>先月のタスク完了数:<?=$lastMonthCompletedCount?></p>
  <p>月平均:<?=$average?></p>

  <!-- 絞り込みフォーム -->
  <form action="./task_record.php" method="get" id="task-sort-form"></form>
  <select name="is_complete" form="task-sort-form">
    <option value="2" <?=$is_complete == 2 ? 'selected disabled' : ''?>>全て</option>
    <option value="1" <?=$is_complete == 1 ? 'selected disabled' : ''?>>完了済み</option>
    <option value="0" <?=$is_complete == 0 ? 'selected disabled' : ''?>>未完了</option>
  </select>
  <button type="submit" form="task-sort-form">絞り込み</button>

  <hr>

  <!-- タスクがあった月だけ出力 -->
  <?php foreach($month as $row) :?>
    <h4><?=date('Y年 m月' ,strtotime($row['date']))?></h4>
    <?php
      //今いるエリアの年・月
      $tmpYM = date('Y-m', strtotime($row['date']));

      //その月のタスクを取得。絞り込み条件で分岐しています。
      if($is_complete == 2) { //すべて表示の場合
        $taskListByMonth = $task->fetchAllTask($user_id, 
          start: date('Y-m-d',strtotime($tmpYM.'-01')), 
          end: date('Y-m-t', strtotime($tmpYM)));
      } else { //完了or未完了の場合
        $taskListByMonth =  $task->fetchTask($user_id, $is_complete, 
          start: date('Y-m-d',strtotime($tmpYM.'-01')), 
          end: date('Y-m-t', strtotime($tmpYM)));
      }
    ?>

    <!-- 月ごとのタスクを表示 -->
    <?php foreach($taskListByMonth as $taskData) :?>
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
        <div class="col-4">
          <!-- タイトル -->
          <p><?=$taskData['title']?></p>
        </div>
        <div class="col-2">
            <p>期限：<?=date('Y-m-d' ,strtotime($taskData['period']))?></p>
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

  <?php endforeach; ?>

<!-- BootStrap CDN-->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>