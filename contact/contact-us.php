<?php
session_start();
$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    // フォームの送信時にエラーをチェックする
    if ($post['name'] === '') {
        $error['name'] = 'blank';
    }
    if ($post['email'] === '') {
        $error['email'] = 'blank';
    } else if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
        $error['email'] = 'email';
    }
    if ($post['contact'] === '') {
        $error['contact'] = 'blank';
    }

    if (count($error) === 0) {
        // エラーがないので確認画面に移動
        $_SESSION['form'] = $post;
        header('Location: confirm.php');
        exit();
    }
} else {
    if (isset($_SESSION['form'])) {
        $post = $_SESSION['form'];
    }
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
        <h3 class="bg-light text-center my-5 py-3">お問い合わせフォーム</h3>

        <div class="form-group px-5">
          <div class="row">
            <div class="col-2">
              <label for="inputName">お名前</label>
            </div><!-- /.col-2 -->
            <div class="col-2">
            <p class="bg-danger text-white text-center rounded require_item">必須</p>
            </div><!-- /.col-2 -->
            <div class="col-md-8">
              <input type="text" name="name" id="inputName" class="form-control" value="<?php echo htmlspecialchars($post['name']); ?>" required autofocus>
                <?php if ($error['name'] === 'blank'): ?>
                  <p class="text-danger text-center error_msg">※お名前をご記入下さい</p>
                <?php endif; ?>
            </div><!-- /.col-md-8 -->
          </div><!-- /.row -->
        </div><!-- /.form-group -->

        <div class="form-group px-5">
          <div class="row">
            <div class="col-2">
              <label for="inputEmail">メールアドレス</label>
            </div><!-- /.col-2 -->
            <div class="col-2">
              <p class="bg-danger text-white text-center rounded require_item">必須</p>
            </div><!-- /.col-2 -->
            <div class="col-8">
              <input type="email" name="email" id="inputEmail" class="form-control" value="<?php echo htmlspecialchars($post['email']); ?>" required>
                <?php if ($error['email'] === 'blank'): ?>
                  <p class="text-danger text-center error_msg">※メールアドレスをご記入下さい</p>
                <?php endif; ?>
                <?php if ($error['email'] === 'email'): ?>
                  <p class="text-danger text-center error_msg">※メールアドレスを正しくご記入ください</p>
                <?php endif; ?>
            </div><!-- /.col-8 -->
          </div><!-- /.row -->
        </div><!-- /.form-group -->

        <div class="form-group px-5">  
          <div class="row">
            <div class="col-2">
              <label for="inputContent">お問い合わせ内容</label>
            </div><!-- /.col-2 -->
            <div class="col-2">
              <p class="bg-danger text-white text-center rounded require_item">必須</p>
            </div><!-- /.col-2 -->
            <div class="col-8">
              <textarea name="contact" id="inputContent" rows="10" class="form-control" required><?php echo htmlspecialchars($post['contact']); ?></textarea>
                <?php if ($error['contact'] === 'blank'): ?>
                  <p class="text-danger text-center error_msg">※お問い合わせ内容をご記入下さい</p>
                <?php endif; ?>
            </div><!-- /.col-8 -->
          </div><!-- /.row -->
        </div><!-- /.form-group -->

        <div class="row">
          <div class="col-8 offset-4 d-flex justify-content-center mt-5">
            <button class="bg-primary text-white text-center rounded py-2 px-2" type="submit">確認画面へ</button>
          </div><!-- /.col-8 -->
        </div><!-- /.row offset-4 -->
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