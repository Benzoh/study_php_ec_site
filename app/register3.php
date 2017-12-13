<?php

require('config.php');

$error = '';

if ($_POST['email1'] == '') {
    $error .= 'メールアドレスが入力されていません<br>';
}
if (strlen($_POST['email1']) > 64) {
    $error .= 'メールアドレスが64文字以上です<br>';
}
if (preg_match('[^!-~]', $_POST['email1'])) {
    $error .= 'メールアドレスに使えない文字が含まれています<br>';
}

if ($_POST['passwd'] == "") {
    $error .= 'パスワードが入力されていません<br>';
}
if (strlen($_POST['passwd']) > 16) {
    $error .= 'パスワードが16文字以上です<br>';
}
if (preg_match('[^!-~]', $_POST['passwd'])) {
    $error .= 'パスワードに使えない文字が含まれています<br>';
}

if ($_POST['name_kanji'] === '') {
    $error .= '姓名（漢字）が入力されていません<br>';
}
if (strlen($_POST['name_kanji']) > 32) {
    $error .= '姓名（漢字）が32文字以上です<br>';
}

if ($_POST['name_kana'] === '') {
    $error .= '姓名（かな）が入力されていません<br>';
}
if (strlen($_POST['name_kana']) > 32) {
    $error .= '姓名（かな）が32文字以上です<br>';
}

if ($_POST['sex'] === '') {
    $error .= '性別が入力されていません<br>';
}
if ($_POST['year'] == '' || $_POST['month'] == '' || $_POST['day'] == '') {
    $error .= '生年月日が入力されていません<br>';
}

if ($_POST['postal1'] == '') {
    $error .= '郵便番号が入力されていません<br>';
}
if ($_POST['xmpf'] == '0') {
    $error .= '都道府県が選択されていません<br>';
}
if ($_POST['address1'] == '') {
    $error .= '住所１が入力されていません<br>';
}

// 接続
$link = mysqli_connect('localhost', 'root', 'root', 'ec_study');

// mysql_select_db('ec_study');
$result = mysqli_query($link, 'set character set utf8');
$sql = "select email1 from users where email1 = '" . mysqli_real_escape_string($link, $_POST['email1']) . "'";
$result = mysqli_query($link, $sql);
// var_dump($result);

if (mysqli_num_rows($result) > 0) {
    $error .= 'このメールアドレスはすでに登録されています<br>';
}

var_dump($error);
if ($error !== '') {
    exit;
}

// 会員データの挿入
$sql = "insert into users (
    login_id,
    passwd,
    register_date,
    name_kanji,
    name_kana,
    sex,
    birth_day,
    email1,
    postal_code,
    xmpf,
    address1,
    address2,
    state
) values (
    '" . mysqli_real_escape_string($link, $_POST['email1']) . "',
    '" . md5($_POST['passwd']) . "',
    '" . date('Y-m-d H:i:s') . "',
    '" . mysqli_real_escape_string($link, $_POST['name_kanji']) . "',
    '" . mysqli_real_escape_string($link, $_POST['name_kana']) . "',
    '" . mysqli_real_escape_string($link, $_POST['sex']) . "',
    '" . mysqli_real_escape_string($link, $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'] . ' 00:00:00') . "',
    '" . mysqli_real_escape_string($link, $_POST['email1']) . "',
    '" . mysqli_real_escape_string($link, $_POST['postal1'] . $_POST['postal2']) . "',
    '" . mysqli_real_escape_string($link, $_POST['xmpf']) . "',
    '" . mysqli_real_escape_string($link, $_POST['address1']) . "',
    '" . mysqli_real_escape_string($link, $_POST['address2']) . "',
    '1'
) ";

var_dump($sql);
$result = mysqli_query($link, $sql);
var_dump($result);

$subject = "$site_name 登録確認メール";
$headers = "From: $support_mail\r\n";
$parameters = '-f' . $support_mail;

$md5 = md5($magic_code . $_POST['email1']);

$body = <<< _EOT_
{$_POST['name_kanji']} 様

この度は、$site_name へのご登録ありがとうございます。
メールアドレス確認のために、下記URLをクリックしてください。

$site_url/register4.php?email1={$_POST['email1']}&md5=$md5

登録メールアアドレス：{$_POST['email1']}
ログインID：{$_POST['email1']}

何かございましたら{$support_mail}まで
お問い合わせいっただけますよう、お願いします。
-------------------------
$site_name
$site_url
_EOT_;

mb_language('ja');
mb_internal_encoding('utf-8');
mb_send_mail($_POST['email1'], $subject, $body, $headers);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sample EC - 会員登録［3/4］</title>
</head>
<body>
    <div align="center">
        Sample EC - 会員登録［3/4］<br>
        <br>
        <div align="center">
            登録メールアドレス宛に確認メールを送信しました。
            メール本文中のURLをクリックし、会員情報を有効にしてください。<br>
            <br>
            ※ 1時間以内に届かない場合、メールアドレスの記入が間違っていたか、<br>
            迷惑メールとして処理されている可能性があります。
        </div>
    </div>
</body>
</html>