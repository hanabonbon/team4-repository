<?php 
namespace task_game;
  session_start(); 
  if(!isset($_SESSION['user_id'])){
    header('location: ./login.php');
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/battle.css?<?php echo date('YmdHis'); ?>">
    <title>対戦画面</title>
  </head>
  <?php
    $user_id = $_SESSION['user_id']; //セッションから取得してください
    require_once('../DAO/User.php');
    $user = new User();
    $myuser = $user->getUserDataByUserId($user_id);
    $enemyUser = $user->getUserDataByUserId(1);//対戦選択画面からゲットで受け取る
    //値を変数に詰め替え 
    //自分のステータス
    $myMaxHP = 100 + 5 * ($myuser['hitpoint']-1);
    $myHP = 100 + 5 * ($myuser['hitpoint']-1);
    $myAT = 20 + 1 * ($myuser['attack']-1);
    $myDE = 5;
    for($i = 1;$i < $myuser['defence'];$i++){
      if($i <= 50){
        $myDE += 0.4;
      }elseif($i <= 100){
        $myDE += 0.5;
      }else{
        $myDE += 0.1;
      }
    }
    $myAG = 10;
    for ($i = 1; $i < $myuser['agility']; $i++) {
      if($i <= 50){
        $myAG += 0.4;
      }elseif($i <= 100){
        $myAG += 0.8;
      }else{
        $myAG += 0.1;
      }
    }
    $myLU = 0.6;
    for($i = 1;$i < $myuser['luck'];$i++){
      if($i <= 50){
        $myLU += 0.6;
      }elseif($i <= 100){
        $myLU += 0.4;
      }else{
        $myLU += 0.1;
      }
    }
    //対戦相手のステータス
    $enemyMaxHP = 100 + 5 * ($enemyUser['hitpoint']-1);
    $enemyHP = 100 + 5 * ($enemyUser['hitpoint']-1);
    $enemyAT = 20 + 1 * ($enemyUser['attack']-1);
    $enemyDE = 5;
    for($i = 1;$i < $enemyUser['defence'];$i++){
      if($i <= 50){
        $enemyDE += 0.4;
      }elseif($i <= 100){
        $enemyDE += 0.5;
      }else{
        $enemyDE += 0.1;
      }
    }
    $enemyAG = 10;
    for ($i = 1; $i < $enemyUser['agility']; $i++) {
      if($i <= 50){
        $enemyAG += 0.4;
      }elseif($i <= 100){
        $enemyAG += 0.8;
      }else{
        $enemyAG += 0.1;
      }
    }
    $enemyLU = 0.6;
    for($i = 1;$i < $enemyUser['luck'];$i++){
      if($i <= 50){
        $enemyLU += 0.6;
      }elseif($i <= 100){
        $enemyLU += 0.4;
      }else{
        $enemyLU += 0.1;
      }
    }
    //ゲームロジック
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // プレイヤーの行動を取得
        $playerAction = isset($_POST["action"]) ? $_POST["action"] : '';
    
        // 対戦相手の行動をランダムに選択
        $opponentActions = ['attack', 'defend', 'evade'];
        $opponentAction = $opponentActions[array_rand($opponentActions)];
    
        // プレイヤーの行動による結果の計算
        switch ($playerAction) {
            case 'attack':
                $damage = $myAT;
                $myHP -= $damage;
                break;
            case 'defend':
                $damage = rand(5, 10);
                $playerHP -= $damage;
                break;
            case 'evade':
                // 何もしない
                break;
            default:
                // 不正なアクションが選択された場合の処理
                break;
        }
    
        // 対戦相手の行動による結果の計算
        switch ($opponentAction) {
            case 'attack':
                $damage = rand(10, 20);
                $playerHP -= $damage;
                break;
            case 'defend':
                $damage = rand(5, 10);
                $opponentHP -= $damage;
                break;
            case 'evade':
                // 何もしない
                break;
            default:
                // 不正なアクションが選択された場合の処理
                break;
        }
    }
  ?>
  <body style="background-color:#FFEED5;">
  <div class="container-fluid">
      <div class="row">
        <h2 class="col-6 text-center mt-3">
            <div><?php echo $myuser['nickname']; ?></div>
            <div>HP:<?= $myHP; ?><meter max="<?= $myMaxHP ?>" value="90"></meter></div>
            <hr>
        </h2>
        <h2 class="col-6 text-center mt-3">
            <div><?php echo $enemyUser['nickname']; ?></div>
            <div>HP:<?= $enemyHP; ?><meter max="<?= $enemyMaxHP ?>" value="90"></meter></div>
            <hr>
        </h2>
      </div>
      <div class="row">
        <div class="col-6 text-center mt-5">
            <img src="../images/<?= $myuser['icon_path'] ?>" class="img-icon">
        </div>
        <div class="col-6 text-center mt-5">
            <img src="../images/<?= $enemyUser['icon_path'] ?>" class="img-icon">
        </div>
      </div>
      <div class="row">
        <div class="col-6 mt-5 pt-5">
            <div class="card">
                <div class="log-style">
                    ユーザはスキルを使用した！
                </div>
            </div>
        </div>
        <div class="col-6 mt-5 pt-5">
            <div class="card-style">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="text-center mt-3 log-style">
                        <input type="radio" name="action" value="attack" checked> 攻撃
                    </div>
                    <div class="text-center mt-3 log-style">
                        <input type="radio" name="action" value="defend"> 防御
                    </div>
                    <div class="text-center mt-3 log-style">
                        <input type="radio" name="action" value="evade"> 回避
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit">決定</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
  </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html