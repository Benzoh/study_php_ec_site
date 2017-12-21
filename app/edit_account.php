<?php

require('config.php');
require('lib.php');

require('xmpf_tbl.php');
// require('pref_tbl.php');

session_start();

if ( ($login = auth()) == false ) {
    header('Location: login.php?redirect=' . $site_url);
    exit;
}

$link = db_connect();
$result = mysqli_query($link, 'set character set utf8');

if (isset($_POST['action']) && $_POST['action'] == 'edit') {
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
    
    $birthday = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'] . ' 00:00:00';

    if (isset($error) && $error == '') {
        $sql = "update users set 
            email1 = '" . mysqli_real_escape_string($_POST['email1']) . "',
            name_kanji = '" . mysqli_real_escape_string($_POST['name_kanji']) . "',
            name_kana = '" . mysqli_real_escape_string($_POST['name_kana']) . "',
            sex = '" . mysqli_real_escape_string($_POST['sex']) . "',
            birthday = '" . mysqli_real_escape_string($bitrhday) . "',
            postal_code = '" . mysqli_real_escape_string($_POST['postal_code']) . "',
            pref = '" . mysqli_real_escape_string($_POST['pref']) . "',
            address1 = '" . mysqli_real_escape_string($_POST['address1']) . "',
            address2 = '" . mysqli_real_escape_string($_POST['address2']) . "',
            where users_id = '" . mysqli_real_escape_string($_SESSION['users_id']) . "'";
        $result = mysqli_query($link, $sql);
        // var_dump($result);
        $error = '変更しました<br>';
    }
}

var_dump($_SESSION);
// $sql = "select * from users where users_id = '" . mysqli_real_escape_string($link, $_SESSION['users_id']) . "'";
// users_idをセッションに含める処理がないためlogin_idに変更
$sql = "select * from users where login_id = '" . mysqli_real_escape_string($link, $_SESSION['login_id']) . "'";
var_dump($sql);

$result = mysqli_query($link, $sql);
$users = mysqli_fetch_array($result);
var_dump($users);

$year = date('Y', strtotime($users['birth_day']));
$month = date('m', strtotime($users['birth_day']));
$day = date('d', strtotime($users['birth_day']));

$title = '会員情報変更';

require('header.php');
require('topbar.php');

?>

<div align="center">
    <h1>会員情報変更</h1>
    <?php if (isset($error)) { echo $error; } ?>
    <table>
        <form action="edit_account.php" method="post">
            <input type="hidden" name="action" value="edit">
            <tr>
                <td align="center">
                    <small><font color="red">*</font>は必須項目です</small>
                </td>
            </tr>
            <tr>
                <td align="right">メールアドレス <font color="red">*</font></td>
                <td><input type="text" name="email1" size==48 maxlength=64 value="<?php echo $users['email1']; ?>"></td>
            </tr>
            <tr>
                <td align="right">メールアドレスの確認<font color="red">*</font></td>
                <td><input type="text" name="email12" size==48 maxlength=64 value="<?php echo $users['email2']; ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><small>半角64文字まで。ログインIDになります（例）benzoh@sample-ec.com</small></td>
            </tr>
            <tr>
                <td align="right">パスワード <font color="red">*</font></td>
                <td><input type="password" name="passwd" size=16 maxlength=16></td>
            </tr>
            <tr>
                <td></td>
                <td><small>半角英数記号16文字まで（例）benzoh.0414</small></td>
            </tr>
            <tr>
                <td align="right">姓名（漢字）<font color="red">*</font></td>
                <td><input type="text" name="name_kanji" size=48 maxlength=32 value="<?php echo $users['name_kanji']; ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><small>半角32文字まで（例）大阪太郎</small></td>
            </tr>
            <tr>
                <td align="right">姓名（かな）<font color="red">*</font></td>
                <td><input type="text" name="name_kana" size=48 maxlength=32 value="<?php echo $users['name_kana']; ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><small>半角32文字まで（例）おおさかたろう</small></td>
            </tr>
            <tr>
                <td align="right">性別</td>
                <td>
                    <input type="radio" name="sex" value=1 <?php if ($users['sex'] == '1') { echo 'checked'; } ?> >男性
                    <input type="radio" name="sex" value=2 <?php if ($users['sex'] == '2') { echo 'checked'; } ?>>女性
                </td>
            </tr>
            <tr>
                <td align="right">生年月日</td>
                <td>
                    <select name="year" id="">
                        <?php
                        for($n = 1905; $n <= 2018; $n++) {
                            if ( $n == $year ) {
                                echo "<option value=$n selected>$n\n";
                            } else {
                                echo "<option value=$n>$n\n";
                            }
                        }
                        ?>
                    </select>年
                    <select name="month" id="">
                        <?php
                        for($n = 1; $n <= 12; $n++) {
                            if ($n == $month) {
                                echo "<option value=$n selected>$n\n";
                            } else {
                                echo "<option value=$n>$n\n";
                            }
                        }
                        ?>
                    </select>月
                    <select name="day" id="">
                        <?php
                        for($n = 1; $n <= 31; $n++) {
                            if ($n == $day) {
                                echo "<option value=$n selected>$n\n";
                            } else {
                                echo "<option value=$n>$n\n";
                            }
                        }
                        ?>
                    </select>日<br>
                </td>
            </tr>
            <tr>
                <!-- TODO: 値ない -->
                <td align="right">郵便番号 <font color="red">*</font></td>
                <td>
                    <input type="text" name="postal1" size="5" maxlength="5" value="<?php echo $users['postal1'];; ?>">
                    <input type="text" name="postal2" size="6" maxlength="6" value="<?php echo $users['postal1'];; ?>">
                </td>
            </tr>
            <tr>
                <td></td>
                <td><small>半角英字[<a href="http://www.post.japanpost.jp/zipcode/" target="_blank">郵便番号検索</a>] （例）100-0000</small></td>
            </tr>
            <tr>
                <td align="right">都道府県</td>
                <td>
                    <select name="xmpf" id="">
                        <?php
                        foreach($xmpf_tbl as $key => $value) {
                            if ($key == $users['xmpf']) {
                                echo "<option value=$key selected>$value\n";
                            } else {
                                echo "<option value=$key>$value\n";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right">住所１<font color="red">*</font></td>
                <td><input type="text" name="address1" size="48" maxlegnth="64" value="<?php echo $users['address1']; ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><small>半角64文字まで（例） 千代田区0-0-0</small></td>
            </tr>
            <tr>
                <td align="right">住所２</td>
                <td><input type="text" name="address2" size="48" maxlength="64" value="<?php echo $users['address2']; ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><small>半角64文字まで（例）サンプルマンション310号室</small></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="- 確認 -"></td>
            </tr>
        </form>
    </table>
</div>

<?php require('footer.php'); ?>