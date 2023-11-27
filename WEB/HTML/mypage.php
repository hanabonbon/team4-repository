<?php
  session_start(); 
  if(!isset($_SESSION['user_id'])){
    header('location: ./login.php');
  }
  $user_id = $_SESSION['user_id'];
  require_once('../DAO/dao.php'); // Include the dao.php file

  // Create an instance of the DAO class
  $dao = new DAO();
  $pdo = $dao->dbConnect();
  $sql = "SELECT nickname,icon_path,skill_point,hitpoint,attack,agility,defence,luck FROM user WHERE user_id = $user_id";
  $ps = $pdo->prepare($sql);
  $ps->execute();
  $result = $ps->fetchAll(PDO::FETCH_ASSOC);
  foreach ($result as $row) {
    $P = $row['skill_point'];
    $sp = $P;
    $H = 100;
    for ($i = 1; $i <= $row['hitpoint']; $i++) {
      $H += 5;
    }
    $A = 20;
    for ($i = 1; $i <= $row['attack']; $i++) {
      $A += 1;
    }
    $S = 10;
    for ($i = 1; $i <= $row['agility']; $i++) {
      if($i <= 50){
        $S += 0.4;
      }elseif($i <= 100){
        $S += 0.8;
      }else{
        $S += 0.1;
      }
    }
    $D = 5;
    for($i = 1;$i <= $row['defence'];$i++){
      if($i <= 50){
        $D += 0.4;
      }elseif($i <= 100){
        $D += 0.5;
      }else{
        $D += 0.1;
      }
    }
    $L = 0.6;
    for($i = 1;$i <= $row['luck'];$i++){
      if($i <= 50){
        $L += 0.6;
      }elseif($i <= 100){
        $L += 0.4;
      }else{
        $L += 0.1;
      }
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
    <link rel="stylesheet" href="../CSS/mypage.css?<?php echo date('YmdHis'); ?>"> <!-- CSSファイルのパスを適切に指定 -->
    <link rel="stylesheet" href="../CSS/menubar.css?<?php echo date('YmdHis'); ?>"> <!-- CSSファイルのパスを適切に指定 -->
    <title>マイページ</title>
    <!-- HTMLのheadセクションにこのスクリプトを追加してください -->
    <script>
      function confirmUpdate() {
        // フォームデータを取得
        var formData = new FormData(document.getElementById('myForm'));

        // フォームデータを配列に変換
        var formDataArray = [];
        formData.forEach(function(value, key) {
          formDataArray.push({ name: key, value: value });
        });

        // 合計値を計算
        var sum = 0;
        formDataArray.forEach(function(item) {
          sum += Number(item.value);
        });

        // スキルポイントの制限値 ($P) を取得
        var skillPointLimit = <?php echo $P; ?>;

        // スキルポイントが足りるかどうかを確認
        if (sum <= skillPointLimit) {
          // JavaScriptの確認ダイアログを使用
          var confirmation = confirm("更新しますか？");

          // ユーザーがOKをクリックした場合
          if (confirmation) {
            // フォームを送信
            document.getElementById('myForm').submit();
          }
        } else {
          // スキルポイントが足りない場合のメッセージを表示
          alert("スキルポイントが足りません");
        }
      }
    </script>
    <script>
      // カウンターの初期値を設定
      let Hcount = 0;
      let Acount = 0;
      let Scount = 0;
      let Dcount = 0;
      let Lcount = 0;
      // カウンターを増加させる関数
      function HCounter1() {
        if(Hcount < <?php echo $sp?>){
          // カウンターの値を1増やす
          Hcount++;
        }
        Hsum = <?php echo $H;?>;
        for(i = 1; i <= Hcount; i++) {
          Hsum += 5;
        }
        var inputElement = document.getElementById("Hc");
        inputElement.value = Hcount;
        // カウンターの表示を更新
        document.getElementById("Hcounter").innerText = Hcount;
        document.getElementById("Hchange").innerText = Hsum.toFixed(1);
      }
      function HCounter2() {
        if(Hcount > 0){
          // カウンターの値を1増やす
          Hcount--;
        }
        Hsum = <?php echo $H;?>;
        for(i = 1; i <= Hcount; i++) {
          Hsum += 5;
        }
        var inputElement = document.getElementById("Hc");
        inputElement.value = Hcount;
        // カウンターの表示を更新
        document.getElementById("Hcounter").innerText = Hcount;
        document.getElementById("Hchange").innerText = Hsum.toFixed(1);
      }
      function ACounter1() {
        if(Acount < <?php echo $sp;?>){
          // カウンターの値を1増やす
          Acount++;
        }
        Asum = <?php echo $A;?>;
        for(i = 1; i <= Acount; i++) {
          Asum += 1;
        }
        var inputElement = document.getElementById("Ac");
        inputElement.value = Acount;
        // カウンターの表示を更新
        document.getElementById("Acounter").innerText = Acount;
        document.getElementById("Achange").innerText = Asum.toFixed(1);
      }
      function ACounter2() {
        if(Acount > 0){
          // カウンターの値を1減らす
          Acount--;
        }
        Asum = <?php echo $A;?>;
        for(i = 1; i <= Acount; i++) {
          Asum += 1;
        }
        var inputElement = document.getElementById("Ac");
        inputElement.value = Acount;
        // カウンターの表示を更新
        document.getElementById("Acounter").innerText = Acount;
        document.getElementById("Achange").innerText = Asum.toFixed(1);
      }
      function SCounter1() {
        if(Scount < <?php echo $sp?>){
          // カウンターの値を1増やす
          Scount++;
        }
        Ssum = <?php echo $S;?>;
        for(i = 1; i <= Scount; i++) {
          SS = <?php echo $row['agility']; ?> + Scount;
          if(SS <= 50){
            Ssum += 0.4;
          }else if(SS <= 100){
            Ssum += 0.8;
          }else{
            Ssum += 0.1;
          }
        }
        var inputElement = document.getElementById("Sc");
        inputElement.value = Scount;
        // カウンターの表示を更新
        document.getElementById("Scounter").innerText = Scount;
        document.getElementById("Schange").innerText = Ssum.toFixed(1);
      }
      function SCounter2() {
        if(Scount > 0){
          // カウンターの値を1減らす
          Scount--;
        }
        Ssum = <?php echo $S;?>;
        for(i = 1; i <= Scount; i++) {
          SS = <?php echo $row['agility']; ?> + Scount;
          if(SS <= 50){
            Ssum += 0.4;
          }else if(SS <= 100){
            Ssum += 0.8;
          }else{
            Ssum += 0.1;
          }
        }
        var inputElement = document.getElementById("Sc");
        inputElement.value = Scount;
        // カウンターの表示を更新
        document.getElementById("Scounter").innerText = Scount;
        document.getElementById("Schange").innerText = Ssum.toFixed(1);
      }
      function DCounter1() {
        if(Dcount < <?php echo $sp?>){
          // カウンターの値を1増やす
          Dcount++;
        }
        Dsum = <?php echo $D;?>;
        for(i = 1; i <= Dcount; i++) {
          DS = <?php echo $row['defence']; ?> + Dcount;
          if(DS <= 50){
            Dsum += 0.4;
          }else if(DS <= 100){
            Dsum += 0.5;
          }else{
            Dsum += 0.1;
          }
        }
        var inputElement = document.getElementById("Dc");
        inputElement.value = Dcount;
        // カウンターの表示を更新
        document.getElementById("Dcounter").innerText = Dcount;
        document.getElementById("Dchange").innerText = Dsum.toFixed(1);
      }
      function DCounter2() {
        if(Dcount > 0){
          // カウンターの値を1減らす
          Dcount--;
        }
        Dsum = <?php echo $D;?>;
        for(i = 1; i <= Dcount; i++) {
          DS = <?php echo $row['defence']; ?> + Dcount;
          if(DS <= 50){
            Dsum += 0.4;
          }else if(DS <= 100){
            Dsum += 0.5;
          }else{
            Dsum += 0.1;
          }
        }
        var inputElement = document.getElementById("Dc");
        inputElement.value = Dcount;
        // カウンターの表示を更新
        document.getElementById("Dcounter").innerText = Dcount;
        document.getElementById("Dchange").innerText = Dsum.toFixed(1);
      }
      function LCounter1() {
        if(Lcount < <?php echo $sp?>){
          // カウンターの値を1増やす
          Lcount++;
        }
        Lsum = <?php echo $L;?>;
        for(i = 1; i <= Lcount; i++) {
          LS = <?php echo $row['luck']; ?> + Lcount;
          if(LS <= 50){
            Lsum += 0.5;
          }else{
            Lsum += 0.1;
          }
        }
        var inputElement = document.getElementById("Lc");
        inputElement.value = Lcount;
        // カウンターの表示を更新
        document.getElementById("Lcounter").innerText = Lcount;
        document.getElementById("Lchange").innerText = Lsum.toFixed(1);
      }
      function LCounter2() {
        if(Lcount > 0){
          // カウンターの値を1減らす
          Lcount--;
        }
        Lsum = <?php echo $L;?>;
        for(i = 1; i <= Lcount; i++) {
          LS = <?php echo $row['luck']; ?> + Lcount;
          if(LS <= 50){
            Lsum += 0.5;
          }else{
            Lsum += 0.1;
          }
        }
        var inputElement = document.getElementById("Lc");
        inputElement.value = Lcount;
        // カウンターの表示を更新
        document.getElementById("Lcounter").innerText = Lcount;
        document.getElementById("Lchange").innerText = Lsum.toFixed(1);
      }
    </script>
  </head>
  <body>
    <form id="myForm" method="post" action="update.php" class="body">
    <div class="container-fluid">
      <div class="row">
          <!-- サイドバー -->
          <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block  text-white sidebar  fixed-top">
            <div class="position-sticky">
                <ul class="nav flex-column">
                  <!--アイコンとユーザー名-->
                  <div class="icon-name">
                    <div class="img-area">
                      <img src="../images/<?PHP echo $row['icon_path'];?>" class="img-icon">
                    </div>
                    <div class="name-area">
                      <label class="username-area"><?php echo $row['nickname']; ?></label>
                    </div>
                  </div>
                  <li class="nav-item active">
                    <!-- タスク上の白線 -->
                    <div class="nav-link"></div>
                      <a class="nav-link" href="task_list.php">タスク</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="mypage.php">マイページ</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="battle.html">対戦</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="ranking.html">ランキング</a>
                  </li>
                </ul>
            </div>
          </nav>
      </div>
    </div>
    <h2>スキルポイント</h2>
    <h2><?php
        echo $row['skill_point']; // ユーザーIDを配列に追加
    ?></h2>
    <p>体力</p>
    <div><button type="button" onclick="HCounter1()">+</button><h id="Hcounter">0</h><button type="button" onclick="HCounter2()">-</button></div>
    <div class="yoko-center">
      <?php
        echo $H; // ユーザーIDを配列に追加
      ?>
      →<h id="Hchange"><?php echo $H;?></h><input type="hidden" class="hnum" name="h" id="Hc" value="0">
    </div><!-- 横線を追加 -->
    <svg xmlns="http://www.w3.org/2000/svg" width="186" height="24" viewBox="0 0 186 24" fill="none">
      <g filter="url(#filter0_d_307_231)">
        <path d="M14 14.0002H13V16.0002H14V14.0002ZM6.86603 1.5L6.36603 0.633975L4.63397 1.63397L5.13397 2.5L6.86603 1.5ZM180.666 2.5L181.166 1.63397L179.434 0.633975L178.934 1.5L180.666 2.5ZM14 16.0002H172.85V14.0002H14V16.0002ZM14.666 15.01L6.86603 1.5L5.13397 2.5L12.934 16.01L14.666 15.01ZM172.866 16.01L180.666 2.5L178.934 1.5L171.134 15.01L172.866 16.01Z" fill="black"/>
      </g>
      <defs>
        <filter id="filter0_d_307_231" x="0.633972" y="0.633789" width="184.532" height="23.376" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
          <feFlood flood-opacity="0" result="BackgroundImageFix"/>
          <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
          <feOffset dy="4"/>
          <feGaussianBlur stdDeviation="2"/>
          <feComposite in2="hardAlpha" operator="out"/>
          <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
          <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_307_231"/>
          <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_307_231" result="shape"/>
        </filter>
      </defs>
    </svg>
    <div class="yoko">
      <div class="info">
        <p class="text-left">攻撃力</p>
        <button type="button" onclick="ACounter1()">+</button><h id="Acounter">0</h><button type="button" onclick="ACounter2()">-</button><br>
        <?php
          echo $A; // ユーザーIDを配列に追加
        ?>
        → <h id="Achange"><?php echo $A;?></h><input type="hidden" class="num" name="a" id="Ac" value="0">
        <svg xmlns="http://www.w3.org/2000/svg" width="230" height="23" viewBox="0 0 230 23" fill="none">
          <path d="M71 22H230M0 0.999974H60M71.834 22.497L59.134 0.5" stroke="black" stroke-width="2"/>
        </svg>
      </div>
      <div class="circle-icon">
        <img class="icon-img" src="../images/DTBBqNQVwAEYiZW.jpg" alt="アイコン画像">
      </div>
      <div class="info">
        <p class="text-right">素早さ</p>
        <button type="button" onclick="SCounter1()">+</button><h id="Scounter">0</h><button type="button" onclick="SCounter2()">-</button><br>
        <?php
          echo $S; // ユーザーIDを配列に追加
        ?>
        %→ <h id="Schange"><?php echo $S;?></h>%<input type="hidden" class="num" name="s" id="Sc" value="0">
        <svg xmlns="http://www.w3.org/2000/svg" width="230" height="24" viewBox="0 0 230 24" fill="none">
          <path d="M159 22.5H0M230 1.49997H170M158.166 22.997L170.866 1" stroke="black" stroke-width="2"/>
        </svg>
      </div>
    </div>
    <div class="yoko2">
      <div class="info">
        <p class="text-left">防御力</p>
        <button type="button" onclick="DCounter1()">+</button><h id="Dcounter">0</h><button type="button" onclick="DCounter2()">-</button><br>
        <?php
          echo $D; // ユーザーIDを配列に追加
        ?>
        %→ <h id="Dchange"><?php echo $D;?></h>%<input type="hidden" class="num" name="d" id="Dc" value="0">
        <svg xmlns="http://www.w3.org/2000/svg" width="230" height="23" viewBox="0 0 230 23" fill="none">
          <path d="M71 22H230M0 0.999974H60M71.834 22.497L59.134 0.5" stroke="black" stroke-width="2"/>
        </svg>
      </div>
      <div class="info">
        <p class="text-right">幸運</p>
        <button type="button" onclick="LCounter1()">+</button><h id="Lcounter">0</h><button type="button" onclick="LCounter2()">-</button><br>
        <?php
          echo $L; // ユーザーIDを配列に追加
        ?>
        %→ <h id="Lchange"><?php echo $L;?></h>%<input type="hidden" class="num" name="l" id="Lc" value="0">
        <svg xmlns="http://www.w3.org/2000/svg" width="230" height="24" viewBox="0 0 230 24" fill="none">
          <path d="M159 22.5H0M230 1.49997H170M158.166 22.997L170.866 1" stroke="black" stroke-width="2"/>
        </svg>
      </div>
    </div>
    <?php
          echo $row['nickname']; // ユーザーIDを配列に追加
        }
    ?>
    <div class="button">
      <button type="button" class="btn btn-primary" onclick="confirmUpdate()">更新</button>
      <a href="information.php" class="btn btn-primary">登録情報</a>
      <a href="logout.php" class="btn btn-primary">ログアウト</a>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </form>
  </body>
</html>