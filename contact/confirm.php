<?php
session_start();

// 入力画面からのアクセスでなければ、戻す
if (!isset($_SESSION['form'])) {
    header('Location: index.php');
    exit();
} else {
    $post = $_SESSION['form'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // メールを送信する
    $to = 'me@example.com';
    $from = $post['email'];
    $subject = 'お問い合わせが届きました';
    $body = <<<EOT
名前： {$post['name']}
メールアドレス： {$post['email']}
内容：
{$post['contact']}
EOT;
    // var_dump($body);
    // exit();
    //mb_send_mail($to, $subject, $body, "From: {$from}");

    // セッションを消してお礼画面へ
    unset($_SESSION['form']);
    header('Location: thanks.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>お問い合わせ | Green Oak PCC Ltd.</title>
  <meta name="description" content="GREEN OAK PCC Ltdは、マレーシアのラブアン島でProtected Cell Captiveを運営しています。企業が抱える事業リスクを精査し、資産としてPCCキャプティブにて管理することにより『コスト』から『アセット』へシフトすることを可能にします。">
    
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/common.css" rel="stylesheet">
  
  <!-- ▼▼ 本番公開時に下記削除 ▼▼ -->
  <meta name="robots" content="noindex">

  <!-- cssファイルの設定など -->


</head>

<body id="contact">
  <header class="container site-header sticky-top py-1">
    <p id="logo"><a href="../index.html"><img src="../images/logo_sitetitle.png" alt="Green Oak PCC ロゴとサイトタイトル"></a></p>
    <ul class="nav justify-content-end fw-bold">
      <li class="nav-item mx-3">
        <a class="nav-link" aria-current="page" href="../index.html">Home</a>
      </li>
      <li class="nav-item mx-3">
        <a class="nav-link" href="../services/services.html">事業内容</a>
      </li>
      <li class="nav-item mx-3">
        <a class="nav-link" href="../about/about.html">会社概要</a>
      </li>
      <li class="nav-item mx-3">
        <a class="nav-link active" href="contact-us.html">お問い合わせ</a>
      </li>
    </ul>
  </header>

  <main>
    <div class="container bg-white my-2">
      <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../index.html"><small>Home</small></a></li>
          <li class="breadcrumb-item active" aria-current="page"><small>お問い合わせ</small></li>
        </ol>
      </nav>
    </div><!-- /.container bg-white my-2 -->

    <header class="d-flex align-items-center justify-content-center main-content-header">
      <h1 class="text-white fw-normal page-title">お問い合わせ</h1>
    </header>

    <section class="container bg-white py-5 my-5">
      <p class="text-center fs-5 lh-lg">当ウェブサイトをご覧いただきありがとうございます。<br>
      ご不明な点やご質問がございましたら、お気軽にお問い合わせください。</p>

      <!-- お問合せフォーム画面 -->
      <form action="" method="POST">
        <div class="form-group">
          <div class="row">
            <div class="col-3">
              <label for="inputName">お名前</label>
            </div><!-- /.col-3 -->
            <div class="col-9">
              <p class="display_item"><?php echo htmlspecialchars($post['name']); ?></p>
            </div><!-- /.col-9 -->
          </div><!-- /.row -->
        </div><!-- /.form-group -->

        <div class="form-group">
          <div class="row">
            <div class="col-3">
              <label for="inputEmail">メールアドレス</label>
            </div><!-- /.col-3 -->
            <div class="col-9">
              <p class="display_item"><?php echo htmlspecialchars($post['email']); ?></p>
            </div><!-- /.col-9 -->
          </div><!-- /.row -->
        </div><!-- /.form-group -->

        <div class="form-group">  
          <div class="row">
            <div class="col-3">
              <label for="inputContent">お問い合わせ内容</label>
            </div><!-- /.col-3 -->
            <div class="col-9">
              <p class="display_item"><?php echo nl2br(htmlspecialchars($post['contact'])); ?></p>
            </div><!-- /.col-9 -->
          </div><!-- /.row -->
        </div><!-- /.form-group -->
        <div class="row">
        <div class="col-9 offset-3">
          <a href="index.php">戻る</a>
          <button type="submit">送信する</button>
        </div><!-- /.col-9 offset-3 -->
        </div><!-- /.row -->
      </form>    
    </section><!-- /.container bg-white py-5 my-5 -->

    <section class="bg-white w-100 ps-md-3 text-center text-box">
      <!-- <h2 class="fs-1 text-primary fw-bold">採用</h2>
      <p>Green Oakチームの成長と、パートナーのビジネス拡大の支援を行っていただける仲間を募集しています。</p> -->

      <hr>
    </section><!-- /.bg-white text-box w-100 my-md-3 ps-md-3 text-center -->
  </main>

  <footer>
    <div class="row">
      <div class="col-12 col-md text-center">
        <small class="d-block mt-3 text-white">&copy; 2021
          <a class="text-white text-decoration-none" href="../index.html">Green Oak PCC Ltd.</a>
            &nbsp;All rights reserved.
        </small>
      </div><!-- /.col-12 col-md text-center-->
    </div><!-- /.row -->
  </footer>

</body>