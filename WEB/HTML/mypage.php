<?php
  require_once('../DAO/dao.php'); // Include the dao.php file

  // Create an instance of the DAO class
  $dao = new DAO();
  $pdo = $dao->dbConnect();
  $sql = "SELECT nickname,skill_point,hitpoint,attack,agility,defence,luck FROM user WHERE user_id = 1";
  $ps = $pdo->prepare($sql);
  $ps->execute();
  $result = $ps->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../CSS/mypage.css"> <!-- CSSファイルのパスを適切に指定 -->
    <title>マイページ</title>
  </head>
  <body>
    <h2>スキルポイント</h2>
    <h2><?php
      foreach ($result as $row) {
        echo $row['skill_point']; // ユーザーIDを配列に追加
    ?></h2>
    <p>体力</p>
    <div class="yoko-center">
      <?php
        echo $row['hitpoint']; // ユーザーIDを配列に追加
      ?> <!-- 横線を追加 -->
      <button type="submit">+</button>
    </div>
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
        <?php
          echo $row['attack']; // ユーザーIDを配列に追加
        ?>
        <button type="submit">+</button>
        <svg xmlns="http://www.w3.org/2000/svg" width="230" height="23" viewBox="0 0 230 23" fill="none">
          <path d="M71 22H230M0 0.999974H60M71.834 22.497L59.134 0.5" stroke="black" stroke-width="2"/>
        </svg>
      </div>
      <div class="circle-icon">
        <img class="icon-img" src="./img/DTBBqNQVwAEYiZW.jpg" alt="アイコン画像">
      </div>
      <div class="info">
        <p class="text-right">素早さ</p>
        <?php
          echo $row['agility']; // ユーザーIDを配列に追加
        ?>
        <button type="submit">+</button>
        <svg xmlns="http://www.w3.org/2000/svg" width="230" height="24" viewBox="0 0 230 24" fill="none">
          <path d="M159 22.5H0M230 1.49997H170M158.166 22.997L170.866 1" stroke="black" stroke-width="2"/>
        </svg>
      </div>
    </div>
    <div class="yoko2">
      <div class="info">
        <p class="text-left">防御力</p>
        <?php
          echo $row['defence']; // ユーザーIDを配列に追加
        ?>
        <button type="submit">+</button>
        <svg xmlns="http://www.w3.org/2000/svg" width="230" height="23" viewBox="0 0 230 23" fill="none">
          <path d="M71 22H230M0 0.999974H60M71.834 22.497L59.134 0.5" stroke="black" stroke-width="2"/>
        </svg>
      </div>
      <div class="info">
        <p class="text-right">幸運</p>
        <?php
          echo $row['luck']; // ユーザーIDを配列に追加
        ?>
        <button type="submit">+</button>
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
      <a href="" class="btn btn-primary">登録情報</a>
      <a href="" class="btn btn-primary">ログアウト</a>
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
</html>