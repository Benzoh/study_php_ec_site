<?php

require('config.php');

// php.ini setting overwrite
if (isset($_POST['keep_login']) && $_POST['keep_login'] != '') {
    session_set_cookie_params(365 * 24 * 3600);
} else {
    session_set_cookie_params(0);
}

session_start();

// db connect
$link = mysqli_connect($db_host, $db_user, $db_password, $db_name);
$result = mysqli_query($link, 'set charecter set utf8');

if (isset($_POST['passwd']) && $_POST['passwd'] == '') {
    $_POST['passwd'] = time();
}

if (isset($_POST['action']) && $_POST['action'] == 'login') {
    $sql = "select * from users where login_id = '" . mysqli_real_escape_string($link, $_POST['login_id']) . "' and state = '0'";
    $result = mysqli_query($link, $sql);
    $users = mysqli_fetch_array($result);

    if ($users['passwd'] == md5($_POST['passwd'])) {
        $_SESSION['login_id'] = $_POST['login_id'];
        // ログインチケット
        $_SESSION['auth_code'] = md5($magic_code . $_POST['login_id']); 
        $_SESSION['name_kanji'] = $users['name_kanji'];

        $sql = "update users set login_date = '" . date('Y-m-d H:i:s') . "'where login_id = '" . mysqli_real_escape_string($_POST['login_id']) . "'and state = '0'";
        $result = mysqli_query($link, $sql);

        if ($_GET['redirect'] != '') {
            header('Location:' . $_GET['redirect']);
            exit;
        } else {
            header('Location:' . $site_url);
            exit;
        }
    } else {
        $message = '<br><br><font color="red">ログインできませんでした</font><br>';
    }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sample EC - ログイン</title>
</head>
<body>
    <div align="center">
        Sample EC - ログイン
        <?php if (isset($message)) { echo $message; } ?>
        <table>
            <form action="login.php?redirect=<?php if(isset($_GET['redirect'])) { echo urlencode($_GET['redirect']); } ?>" method="post">
                <input type="hidden" name="action" value="login">
                <tr>
                    <tr align="center" colspan=2>
                        <?php if (isset($system_message)) { echo $system_message; } ?>
                    </tr>
                </tr>
                <tr>
                    <td align="right">ログインID</td>
                    <td><input type="text" name="login_id" size=32 maxlength=64></td>
                </tr>
                <tr>
                    <td align="right">パスワード</td>
                    <td><input type="password" name="passwd" size=16 maxlength=32></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="checkbox" name="keep_login">
                        次回からログインを省略する
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="- ログイン -"></td>
                </tr>
            </form>
        </table>
    </div>
</body>
</html>