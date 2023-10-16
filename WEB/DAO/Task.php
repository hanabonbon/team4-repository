<?php
  class Task {
    private $pdo;
    
    public function __construct() {
      require_once('connection.php');
      $connection = new Connection();
      $this->pdo = $connection->getPdo();
    }
    
    //サンプル
    public function getTaskById($task_id) {
      $sql = "SELECT * FROM task WHERE task_id = ?";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(1, $task_id, PDO::PARAM_INT);
      $ps->execute();
      $result = $ps->fetchAll(PDO::FETCH_ASSOC);
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

    public function getTaskDataById($task_id) {
      $sql = "SELECT * FROM task WHERE task_id = ?";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(1, $task_id, PDO::PARAM_INT);
      $ps->execute();
      $result = $ps->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }

    public function insertTask($newTaskData) {
      $sql = "INSERT INTO task (title, detail, period, is_complete, user_id) VALUES (?, ?, ?, ?, ?)";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(1, $newTaskData['title'], PDO::PARAM_STR);
      $ps->bindValue(2, $newTaskData['detail'], PDO::PARAM_STR);
      $ps->bindValue(3, $newTaskData['period'], PDO::PARAM_STR);
      $ps->bindValue(4, $newTaskData['is_complete'], PDO::PARAM_INT);
      $ps->bindValue(5, $newTaskData['user_id'], PDO::PARAM_INT);

      $ps->execute();
    }
  }
?>