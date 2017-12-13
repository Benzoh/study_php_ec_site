<?php

// register4.php

require('config.php');

// db connect

// $link = mysqli_connect($db_host, $db_user, $db_password);
// mysql_select_db($db_name);

// $link = mysqli_connect('localhost', 'root', 'root', 'ec_study');
$link = mysqli_connect($db_host, $db_user, $db_password, $db_name);
$result = mysqli_query($link, 'set character set utf8');

// activation
$sql = "select email1 from users where email1 = '" . mysqli_real_escape_string($link, $_GET['email1']) . "'";
$result = mysqli_query($link, $sql);
$users = mysqli_fetch_array($result);

if (md5($magic_code . $users['email1']) == $_GET['md5']) {
    $sql = "update users set state = '0' where email1 = '" . mysqli_real_escape_string($link, $_GET['email1']) . "'";
    $result = mysqli_query($link, $sql);
    $message = '認証は成功しました。<br><a href="login.php">ログインページ</a>からログインしてください。';
} else {
    $message = '認証は失敗しました。<br>サポートまでお問い合わせください。';
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sample EC - 会員登録［4/4］</title>
</head>
<body>
    <div align="center">
    Sample EC - 会員登録［4/4］<br>
    <br>
    <?php echo $message; ?>
    </div>
</body>
</html>
