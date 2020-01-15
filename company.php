<?php
//変数の初期化
$page_flag = 0;

if( !empty($_POST['btn_confirm'])) {
  $page_flag = 1;

} elseif ( !empty($_POST['btn_submit'])) {
  $page_flag = 2;

  // 変数とタイムゾーンを初期化
$header = null;
$auto_reply_subject = null;
$auto_reply_text = null;
date_default_timezone_set('Asia/Tokyo');

// ヘッダー情報を設定
$header = "MIME-Version: 1.0\n";
$header .= "From: 声優マガジン <info@togeibrain.co.jp>\n";
$header .= "Reply-To: 声優マガジン <info@togeibrain.co.jp>\n";

// 運営側へ送るメールの件名
$admin_reply_subject = "お問い合わせを受け付けました";

// 本文を設定
$admin_reply_text = "下記の内容でお問い合わせがありました。\n\n";
$admin_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
$admin_reply_text .= "お名前：" . $_POST['name'] . "\n";
$admin_reply_text .= "メールアドレス：" . $_POST['email'] . "\n";
$admin_reply_text .= "お問い合わせ内容：" . $_POST['textarea'];

// 運営側へメール送信
mb_send_mail( 'info@togeibrain.co.jp', $admin_reply_subject, $admin_reply_text, $header);

} else {
  $page_flag = 0;
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="声優エンタメサイト【声優マガジン】を運営する、株式会社東芸ブレインへのお問い合わせフォームです。">
    <title>運営会社　お問い合わせフォーム | 声優マガジン</title>
    <link rel="icon" type="image/png" href="assets/images/common/favicon.png">
    <link rel="stylesheet" href="assets/css/validationEngine.jquery.css">
    <link rel="stylesheet" href="assets/css/jquery.fancybox.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
    <script src="assets/js/jquery.validationEngine.js"></script>
    <script src="assets/js/languages/jquery.validationEngine-ja.js"></script>
    <script src="assets/js/script.js"></script>
    <script>
        $(document).ready(function(){
            $("#theForm").validationEngine({
                promptPosition: "topLeft",//エラー文の表示位置
                showArrowOnRadioAndCheckbox: true,//エラー箇所の図示
                focusFirstField: false,//エラー時に一番文頭の入力フィールドにフォーカスさせるかどうか
                scroll: false
            });
        });
    </script>
</head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-115044264-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-115044264-2');
</script>

<body id="page">
    <div class="wrapper">
        <section class="box_others">
            <h1 class="box_others_title">運営会社</h1>
            <table>
                <tr>
                    <th>会社名</th>
                    <td>株式会社　東芸ブレイン</td>
                </tr>
                <tr>
                    <th>設立</th>
                    <td>2016年6月29日</td>
                </tr>
                <tr>
                    <th>資本金</th>
                    <td>1,000万円</td>
                </tr>
            </table>
        </section>
        <section class="box_others">
            <h1 class="box_others_title">お問い合わせフォーム</h1>
            <?php if( $page_flag === 1): ?>
                <form action="" id="flag1" method="post">
                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                    <input type="hidden" name="email" value="<?php echo $email; ?>">
                    <input type="hidden" name="textarea" value="<?php echo $textarea; ?>">
                    <div class="form_inner form_confirm">
                        <dl>
                            <dt class="text_bold">お名前<span class="must text_bold">必須</span></dt>
                            <dd>
                                <p><?php echo $_POST['name']; ?></p>
                            </dd>
                            <dt class="text_bold">e-mail<span class="must text_bold">必須</span></dt>
                            <dd>
                                <p><?php echo $_POST['email']; ?></p>
                            </dd>
                            <dt class="text_bold">お問い合わせ内容<span class="must text_bold">必須</span></dt>
                            <dd>
                                <p><?php echo $_POST['textarea']; ?></p>
                            </dd>
                        </dl>
                        <div class="btns">
                            <input type="button" value="内容を修正する" onclick="history.back(-1)" class="btn btn_gray">
                            <input type="submit" value="送信する" class="btn" name="btn_submit">
                            <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
                            <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
                            <input type="hidden" name="textarea" value="<?php echo $_POST['textarea']; ?>">
                        </div>
                    </div>
                </form>

            <?php elseif( $page_flag === 2): ?>
            <p>送信が完了しました。</p>

            <?php else: ?>

            <form action="#contact" id="theForm" method="post">
                <div class="form_inner">
                    <dl>
                        <dt class="text_bold">お名前<span class="must text_bold">必須</span></dt>
                        <dd>
                            <input type="text" data-validation-engine="validate[required]" name="name">
                        </dd>
                        <dt class="text_bold">e-mail<span class="must text_bold">必須</span></dt>
                        <dd>
                            <input type="email" data-validation-engine="validate[required],custom[email]" name="email">
                        </dd>
                        <dt class="text_bold">お問い合わせ内容<span class="must text_bold">必須</span></dt>
                        <dd>
                            <textarea id="" cols="30" rows="10" data-validation-engine="validate[required]" name="textarea"></textarea>
                        </dd>
                    </dl>
                    <input type="submit" value="入力内容を確認する" class="text_bold" name="btn_confirm">
                </div>
            </form>
            <?php endif; ?>
        </section>
    </div><!--//.wrapper-->

    <!--フッター-->
    <footer class="footer">
        <div class="footer_inner">
            <div class="footer_content">
                <div class="footer_main">
                    <p class="footer_main_logo"><a href="/"><img src="assets/images/common/logo_white.png" alt="声優マガジン"></a></p>
                    <p class="footer_main_description">声マガは声優ファンのための声優エンタメサイトです。</p>
                    <p class="footer_main_twitter"><a href="https://twitter.com/seimaga_pr?ref_src=twsrc%5Etfw" class="twitter-follow-button" data-show-count="false">最新情報は<i class="fab fa-twitter"></i>をフォロー</a></p>
                </div>
                <ul class="footer_list">
                    <li class="footer_list_item link"><a href="about.html">このサイトについて</a></li>
                    <li class="footer_list_item link"><a href="terms.html">利用規約</a></li>
                    <li class="footer_list_item link"><a href="company.php">運営会社</a></li>
                </ul>
            </div><!--//.footer_content-->
            <small>&copy;<script>document.write(new Date().getFullYear());</script> All Rights Reserved 声優マガジン</small>
        </div>
    </footer>
    <!--//フッター-->

    <!--トップに戻る-->
    <p class="button-pagetop" style=""><a href="#wrap">▲</a></p>
    <!--//トップに戻る-->

</body>

</html>
