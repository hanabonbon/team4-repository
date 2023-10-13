<?php
//データベースに接続
require_once './dao.php';
$dao = new DAO();
$pdo = $dao->dbConnect();

public function getTasksToday($userId){
    //SQLの生成
    $sql = "SELECT * FROM task WHERE user_id = ?";

    //戻り値を変数に保持
    $ps = $pdo -> prepare($sql);

    //'?'に値を設定
    $ps->bindValue(1,$userId,PDO::PARAM_INT);

    //SQL実行
    $ps->execute();

    //実行結果を配列に格納
    $result = $ps->fetchAll(PDO::FETCH_ASSOC);

    if(empty($result)){
        echo '指定したIDに該当するデータはありません。';
    }else{
        foreach($result as $row){
            $tasks = $row['user_id'];
        }
    }
    return $tasks;
}

?>