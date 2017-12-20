<?php

require('config.php');
require('lib.php');

session_start();

if (($login = auth()) == false) {
    header('Location: login.php?redirect=login.php');
    exit;
}

$link = db_connect();
$result = mysqli_query($link, 'set character set utf8');

require('header.php');
require('topbar.php');

?>

<h1>アカウント</h1>
<h2>注文</h2>
<a href="order_history.php">注文履歴</a><br>
<h2>アカウント設定</h2>
<a href="edit_account.php">アカウント情報の編集</a><br>
<a href="edit_login_id.php">ログインIDの変更</a><br>
<a href="edit_passwd.php">パスワードの変更</a><br>


<?php
require('footer.php');
?>