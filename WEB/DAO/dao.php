<?php
class DAO{
    //データベースに接続する
    public function dbConnect(){
        $pdo = new PDO('mysql:host=localhost; dbname=task_game; charset=utf8',
                        'webuser', 'abccsd2');
        return $pdo;
    }
}
?>