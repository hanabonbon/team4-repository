<?php
  class Task {
    private $pdo;
    
    public function __construct() {
      require_once('connection.php');
      $connection = new Connection();
      $this->pdo = $connection->getPdo();
    }
    
    public function getTaskById($task_id) {
      $sql = "SELECT * FROM task WHERE task_id = ?";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(1, $task_id, PDO::PARAM_INT);
      $ps->execute();
      //該当する1件を取得
      $result = $ps->fetch(PDO::FETCH_ASSOC);
      return $result;
    }

    //useridからtaskidを取得
    public function getUserIdByTaskTitle($user_id){
      $sql = "SELECT * FROM task WHERE user_id = ?";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(1,$user_id,PDO::PARAM_INT);
      $ps->execute();
      $result = $ps->fetch(PDO::FETCH_ASSOC);
      
      return $result['title'];
    }

    public function insertTask($user_id, $newTaskData) {
      $sql = "INSERT INTO task (title, detail, period, created_time, user_id) 
              VALUES (:title, :detail, :period, :created_time, :user_id)";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(':title', $newTaskData['title'], PDO::PARAM_STR);
      $ps->bindValue(':detail', $newTaskData['detail'], PDO::PARAM_STR);
      $ps->bindValue(':period', $newTaskData['period'], PDO::PARAM_STR);
      $ps->bindValue('created_time', date('Y-m-d H:i:s'), PDO::PARAM_STR);
      $ps->bindValue(':user_id', $user_id, PDO::PARAM_INT);
      $ps->execute();
    }

    //完了状況の更新は別で行う
    public function updateTask($newTaskData) {
      $sql = "UPDATE task SET 
              title = :title, 
              detail = :detail, 
              period = :period, 
              last_edit_time = :last_edit_time 
              WHERE task_id = :task_id";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(':title', $newTaskData['title'], PDO::PARAM_STR);
      $ps->bindValue(':detail', $newTaskData['detail'], PDO::PARAM_STR);
      $ps->bindValue(':period', $newTaskData['period'], PDO::PARAM_STR);
      $ps->bindvalue(':last_edit_time', date('Y-m-d H:i:s') ,PDO::PARAM_STR);
      $ps->bindValue(':task_id', $newTaskData['task_id'], PDO::PARAM_INT);
      $ps->execute();
    }

    //完了状況の更新
    public function updateTaskState($task_id, $is_complete) {
      $sql = "UPDATE task SET 
              is_complete = :is_complete, 
              completion_time = :completion_time 
              WHERE task_id = :task_id";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(':is_complete', $is_complete, PDO::PARAM_INT);
      $ps->bindValue(':completion_time', date('Y-m-d H:i:s') ,PDO::PARAM_STR);
      $ps->bindValue(':task_id', $task_id, PDO::PARAM_INT);
      $ps->execute();
    }
  }
?>