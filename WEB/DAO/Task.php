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
    public function getAllTaskByUserId($user_id){
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
    
    public function fetchTodayTaskList($user_id){
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

    public function fetchTaskByPeriod($user_id, $start, $end='9999-12-31'){
      $sql = "SELECT * FROM task 
              WHERE period BETWEEN :start AND :end 
              AND user_id = :user_id
              ORDER BY period ASC";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(':start', $start, PDO::PARAM_STR);
      $ps->bindValue(':end', $end, PDO::PARAM_STR);
      $ps->bindValue(':user_id', $user_id, PDO::PARAM_INT);
      $ps->execute();
      $result = $ps->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }

  }
?>