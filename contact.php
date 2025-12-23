<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    // POSTでのアクセスでない場合
    $name = '';
    $email = '';
    $subject = '';
    $message = '';
    $err_msg = '';
    $complete_msg = '';

} else {
    // フォームがサブミットされた場合（POST処理）
    // 入力された値を取得する
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // エラーメッセージ・完了メッセージの用意
    $err_msg = '';
    $complete_msg = '';

    // 空チェック
    if ($name == '' || $email == '' || $subject == '' || $message == '') {
        $err_msg = '全ての項目を入力してください。';
    }

    // エラーなし（全ての項目が入力されている）
    if ($err_msg == '') {
        $to = 'tochio0921@gmail.com'; // 管理者のメールアドレスなど送信先を指定
        $headers = "From: " . $email . "\r\n";

        // 本文の最後に名前を追加
        $message .= "\r\n\r\n" . $name;

        // メール送信
        mb_send_mail($to, $subject, $message, $headers);

        // 完了メッセージ
        $complete_msg = '送信されました！';

        // 全てクリア
        $name = '';
        $email = '';
        $subject = '';
        $message = '';
    }
}
?>
<!DOCTYPE html>
<html lang="jp">
    <head>
        <meta charset="utf-8">
        <title>お問い合わせフォーム</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
        <link rel="shortcut icon" href="img/アイコン_03.png" />

        <style>
            body {
                background: #f3f3f3;
                font-family: "Montserrat","Helvetica Neue",Arial,"Hiragino Kaku Gothic ProN","Hiragino Sans",Meiryo,sans-serif;
                background-color: #f7f7f7;
            }
            h3{
                font-size: 34px;
                font-weight: bold;
                line-height: 1;
                margin-bottom: 40px;
                text-align: center;
                letter-spacing: .05em;
                color: #333;
            }
            .subpage_header_in {
                position: relative;
                width: 80%;
                max-width: 960px;
                padding-top: 40px;
                margin: 0 auto;
            }
            .subpage_header_in .header_menu {
                text-align: left;
            }
            ul {
                margin-top: 0;
                margin-bottom: 10px;
                list-style: none;
                color: #333;
                display: block;
                margin-block-start: 1em;
                margin-block-end: 1em;
                margin-inline-start: 0px;
                margin-inline-end: 0px;
                padding-inline-start: 40px;
            }
            li{
                float:left;
                padding:10px;
            }
            li a{
                color: #333;
                text-decoration: none; 
            }
            li a:hover{
                color: #999;
                transition: color .3s;
            }
        </style>

    </head>
<body>

    <header>
        <div class="subpage_header_in">
            <div class="header_menu">
                <ul class="header_menu_ul">
                    <li class="retop">
                        <a href="index.html">TOP</a>
                    </li>
                    <li>
                        〉
                    </li>
                    <li>
                        CONTACT
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h3 class="mb-5 text-center">CONTACT</h3>

                <?php if ($err_msg != ''): ?>
                <div class="alert alert-danger">
                    <?php echo $err_msg; ?>
                </div>
                <?php endif; ?>

                <?php if ($complete_msg != ''): ?>
                <div class="alert alert-success">
                    <?php echo $complete_msg; ?>
                </div>
                <?php endif; ?>

                <form method="post">
                    <div class="mb-3">
                    <input type="text" class="form-control" name="name" placeholder="お名前" value="<?php echo $name; ?>">
                    </div>
                    <div class="mb-3">
                    <input type="text" class="form-control" name="email" placeholder="メールアドレス" value="<?php echo $email; ?>">
                    </div>
                    <div class="mb-3">
                    <input type="text" class="form-control" name="subject" placeholder="件名" value="<?php echo $subject; ?>">
                    </div>
                    <div class="mb-4">
                    <textarea class="form-control" name="message" rows="5" placeholder="本文"><?php echo $message; ?></textarea>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">送信</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>