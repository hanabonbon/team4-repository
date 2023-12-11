<?php
namespace task_game;
use DAO;
use PDO;
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location: ./login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // フォームデータを取得
    $h = $_POST['h'];
    $a = $_POST['a'];
    $s = $_POST['s'];
    $d = $_POST['d'];
    $l = $_POST['l'];

    // データベースの更新処理を実行する関数を呼び出す（この部分は実際の更新処理に合わせてください）
    updateDatabase($user_id, $h, $a, $s, $d, $l);

    // フォームが更新されたことを示すメッセージを表示する（任意のメッセージに変更してください）
    echo "データベースが更新されました。";
} else {
    // POSTリクエストでない場合は、不正なアクセスとみなして処理を終了
    echo "不正なアクセスです。";
}

function updateDatabase($user_id, $h, $a, $s, $d, $l) {
    // データベースへの接続など、実際の更新処理を実装してください
    // 以下はサンプルのため、実際の処理に合わせてください
    require_once('../DAO/dao.php');

    $dao = new DAO();
    $pdo = $dao->dbConnect();

    $sum = $h + $a + $s + $d + $l;

    // 現在のデータを取得
    $currentData = getCurrentData($pdo, $user_id);

    // フォームからのデータを元のデータに加算
    $p = $currentData['skill_point'] - $sum;
    $h += $currentData['hitpoint'];
    $a += $currentData['attack'];
    $s += $currentData['agility'];
    $d += $currentData['defence'];
    $l += $currentData['luck'];

    // 仮の更新クエリ
    $sql = "UPDATE user SET skill_point = :p, hitpoint = :h, attack = :a, agility = :s, defence = :d, luck = :l WHERE user_id = :user_id";
    $ps = $pdo->prepare($sql);

    $ps->bindParam(':p', $p, PDO::PARAM_INT);
    $ps->bindParam(':h', $h, PDO::PARAM_INT);
    $ps->bindParam(':a', $a, PDO::PARAM_INT);
    $ps->bindParam(':s', $s, PDO::PARAM_INT);
    $ps->bindParam(':d', $d, PDO::PARAM_INT);
    $ps->bindParam(':l', $l, PDO::PARAM_INT);
    $ps->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    $ps->execute();
}
function getCurrentData($pdo, $user_id) {
    // 現在のデータを取得するためのクエリ
    $sql = "SELECT skill_point, hitpoint, attack, agility, defence, luck FROM user WHERE user_id = :user_id";
    $ps = $pdo->prepare($sql);
    $ps->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $ps->execute();

    // 結果を連想配列として取得
    $currentData = $ps->fetch(PDO::FETCH_ASSOC);

    return $currentData;
}
header('location: ./mypage.php');
?>
