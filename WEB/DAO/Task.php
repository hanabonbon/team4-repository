<?php
  class Task {
    private $pdo;
    
    public function __construct() {
      require_once('connection.php');
      $connection = new Connection();
      $this->pdo = $connection->getPdo();
    }
    
    //task_idからタスクを1件取得
    public function getTaskById($task_id) {
      $sql = "SELECT * FROM task WHERE task_id = ?";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(1, $task_id, PDO::PARAM_INT);
      $ps->execute();
      //該当する1件を取得
      $result = $ps->fetch(PDO::FETCH_ASSOC);
      return $result;
    }

    //useridからタスクを全件取得
    public function getAllTaskByUserId($user_id) {
      $sql = "SELECT * FROM task WHERE user_id = ?";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(1,$user_id,PDO::PARAM_INT);
      $ps->execute();
      $result = $ps->fetchAll(PDO::FETCH_ASSOC);
      
      return $result;
    }

    //タスクの新規作成
    public function insertTask($user_id, $newTaskData) {
      $sql = "INSERT INTO task (title, detail, period, is_complete, completion_time, created_time, user_id) 
              VALUES (:title, :detail, :period, :is_complete, :completion_time, :created_time, :user_id)";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(':title', $newTaskData['title'], PDO::PARAM_STR);

      //パラメータがない場合はnullで登録
      if(isset($newTaskData['detail'])){
        $ps->bindValue(':detail', $newTaskData['detail'], PDO::PARAM_STR);
      } else {
        $ps->bindValue(':detail', "", PDO::PARAM_STR);
      }

      $ps->bindValue(':period', $newTaskData['period'], PDO::PARAM_STR);

      //パラメータがない場合は未完了で登録
      if(isset($newTaskData['is_complete'])){
        $ps->bindValue(':is_complete', $newTaskData['is_complete'], PDO::PARAM_INT);
        //完了している場合は完了時間を登録
        if($newTaskData['is_complete']) {
          $ps->bindValue(':completion_time', date('Y-m-d H:i:s') ,PDO::PARAM_STR);
        } else {
          $ps->bindValue(':completion_time', null ,PDO::PARAM_STR);
        }
      } else {//パラメータがない場合は未完了、時間：nullで登録
        $ps->bindValue(':is_complete', 0, PDO::PARAM_INT);
        $ps->bindValue(':completion_time', null ,PDO::PARAM_STR);
      }

      $ps->bindValue(':created_time', date('Y-m-d H:i:s'), PDO::PARAM_STR);
      $ps->bindValue(':user_id', $user_id, PDO::PARAM_INT);
      $ps->execute();
    }

    //タスクの編集
    public function updateTask($newTaskData) {
      $sql = "UPDATE task SET 
              title = :title, 
              detail = :detail, 
              period = :period, 
              is_complete = :is_complete,
              completion_time = :completion_time,
              last_edit_time = :last_edit_time 
              WHERE task_id = :task_id";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(':title', $newTaskData['title'], PDO::PARAM_STR);
      $ps->bindValue(':detail', $newTaskData['detail'], PDO::PARAM_STR);
      $ps->bindValue(':period', $newTaskData['period'], PDO::PARAM_STR);
      $ps->bindValue(':is_complete', $newTaskData['is_complete'], PDO::PARAM_INT);
      if($newTaskData['is_complete']) {
        $ps->bindValue(':completion_time', date('Y-m-d H:i:s') ,PDO::PARAM_STR);
      } else {
        $ps->bindValue(':completion_time', null ,PDO::PARAM_STR);
      }
      $ps->bindvalue(':last_edit_time', date('Y-m-d H:i:s') ,PDO::PARAM_STR);
      $ps->bindValue(':task_id', $newTaskData['task_id'], PDO::PARAM_INT);
      $ps->execute();
    }

    //タスク状況の更新
    public function updateTaskState($task_id, $is_complete) {
      $sql = "UPDATE task SET 
              is_complete = :is_complete, 
              completion_time = :completion_time 
              WHERE task_id = :task_id";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(':is_complete', $is_complete, PDO::PARAM_INT);
      if($is_complete) {
        $ps->bindValue(':completion_time', date('Y-m-d H:i:s') ,PDO::PARAM_STR);
      } else {
        $ps->bindValue(':completion_time', null ,PDO::PARAM_STR);
      }
      
      $ps->bindValue(':task_id', $task_id, PDO::PARAM_INT);
      $ps->execute();
    }

    //完了状況に関わらず取得する関数だけは別で作る必要がある。
    
    //ユーザー、完了状況を指定してタスクを取得する
    //期限(period)を'start','end'の範囲で指定できる
    //日付を指定しなかった場合は全期間のタスクを取得する
    //'start'だけを指定した場合は'start'以降の全期間のタスクを取得する
    //'end'だけを指定した場合は'end'以前の全期間のタスクを取得する
    public function fetchTaskByUserId($user_id, //必須
                                      bool $is_complete, //完了しているか？（必須）
                                      bool $asc=true, //ソート（指定しなくてもよい）
                                      $start='1900-01-01', //指定しなくてもよい
                                      $end='9999-12-31' //指定しなくてもよい
                                     ){
      $sortQuery = $asc ? "ORDER BY period ASC" : "ORDER BY period DESC";
      $sql = "SELECT * FROM task 
              WHERE user_id = :user_id
              AND is_complete = :is_complete
              AND period BETWEEN :start AND :end 
              ".$sortQuery;
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(':user_id', $user_id, PDO::PARAM_INT);
      $ps->bindValue(':is_complete', $is_complete, PDO::PARAM_INT);
      $ps->bindValue(':start', $start.' 00:00:00', PDO::PARAM_STR);
      $ps->bindValue(':end', $end.' 23:59:59', PDO::PARAM_STR);
      $ps->execute();
      $result = $ps->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }

    //ユーザーIDを指定して、完了状況に関わらずタスクを取得します。
    public function fetchAllTask($user_id, //必須
                                 bool $asc=true, //ソート（指定しなくてもよい）
                                 $start='1900-01-01', //指定しなくてもよい
                                 $end='9999-12-31' //指定しなくてもよい
                                ){
      $sortQuery = $asc ? "ORDER BY period ASC" : "ORDER BY period DESC";
      $sql = "SELECT * FROM task 
              WHERE user_id = :user_id
              AND period BETWEEN :start AND :end 
              ".$sortQuery;
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(':user_id', $user_id, PDO::PARAM_INT);
      $ps->bindValue(':start', $start.' 00:00:00', PDO::PARAM_STR);
      $ps->bindValue(':end', $end.' 23:59:59', PDO::PARAM_STR);
      $ps->execute();
      $result = $ps->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }

    //指定した期間の、完了(or未完了)タスクの数を取得する
    //数値だけを返します
    public function countCompletedTask($user_id, 
                                       bool $is_complete=true, 
                                       $start='1900-01-01', 
                                       $end='9999-12-31') {
      $sql = "SELECT COUNT(*) FROM task 
              WHERE user_id = :user_id
              AND is_complete = :is_complete
              AND period BETWEEN :start AND :end";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(':user_id', $user_id, PDO::PARAM_INT);
      $ps->bindValue(':is_complete', $is_complete, PDO::PARAM_INT);
      $ps->bindValue(':start', $start.' 00:00:00', PDO::PARAM_STR);
      $ps->bindValue(':end', $end.' 23:59:59', PDO::PARAM_STR);
      $ps->execute();
      $result = $ps->fetch(PDO::FETCH_ASSOC);
      return $result['COUNT(*)'];
    }

    //完了数の月平均を取得する
    //良い名前が思いつかない。
    function averageCompletedCountByMonth($user_id) {
      $sql = "SELECT ROUND(AVG(count), 2) as 'month_average'
              FROM (
                SELECT DATE_FORMAT(period, '%Y-%m') AS date, 
                  COUNT(*) AS count
                  FROM task
                  WHERE user_id = :user_id
                  AND is_complete = true
                  GROUP BY DATE_FORMAT(period, '%Y%m')
              ) as subquery;";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(':user_id', $user_id, PDO::PARAM_INT);
      $ps->execute();
      $result = $ps->fetch(PDO::FETCH_ASSOC);
      return $result['month_average'];
    }

    public function fetchTodayTaskList($user_id) {
      $sql = "SELECT * FROM task 
              WHERE period BETWEEN :start AND :end 
              AND user_id = :user_id
              ORDER BY period ASC";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(':start', date('Y-m-d').' 00:00:00', PDO::PARAM_STR);
      $ps->bindValue(':end', date('Y-m-d').' 23:59:59', PDO::PARAM_STR);
      $ps->bindValue(':user_id', $user_id, PDO::PARAM_INT);
      $ps->execute();
      $result = $ps->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }
  }
?>