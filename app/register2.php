<?php
require('xmpf_tbl.php');
// require('pref_tbl.php');

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

// エラー画面
if ($error !== ''):
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sample EC - 会員登録［エラー］</title>
</head>
<body>
    <div align="center">
        Sample EC - 会員登録［エラー］<br>
        <br>
        <?php echo $error; ?>
        <br>
        ブラウザバックで戻り、入力を確認してください。
    </div>
</body>
</html>

<?php
exit;
endif;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sample EC - 会員登録［2/4］</title>
</head>
<body>
    <div align="center">
        Sample EC - 会員登録［2/4］<br>
        <br>
        <table>
            <form action="register3.php" method="post">
                <input type="hidden" name="email1" value="<?php echo htmlspecialchars($_POST['email1']); ?>">
                <input type="hidden" name="passwd" value="<?php echo htmlspecialchars($_POST['passwd']); ?>">
                <input type="hidden" name="name_kanji" value="<?php echo htmlspecialchars($_POST['name_kanji']); ?>">
                <input type="hidden" name="name_kana" value="<?php echo htmlspecialchars($_POST['name_kana']); ?>">
                <input type="hidden" name="sex" value="<?php echo htmlspecialchars($_POST['sex']); ?>">
                <input type="hidden" name="year" value="<?php echo htmlspecialchars($_POST['year']); ?>">
                <input type="hidden" name="month" value="<?php echo htmlspecialchars($_POST['month']); ?>">
                <input type="hidden" name="day" value="<?php echo htmlspecialchars($_POST['day']); ?>">
                <input type="hidden" name="postal1" value="<?php echo htmlspecialchars($_POST['postal1']); ?>">
                <input type="hidden" name="postal2" value="<?php echo htmlspecialchars($_POST['postal2']); ?>">
                <input type="hidden" name="xmpf" value="<?php echo htmlspecialchars($_POST['xmpf']); ?>">
                <input type="hidden" name="address1" value="<?php echo htmlspecialchars($_POST['address1']); ?>">
                <input type="hidden" name="address2" value="<?php echo htmlspecialchars($_POST['address2']); ?>">
                <tr>
                    <td align="right">メールアドレス</td>
                    <td><?php echo $_POST['email1']; ?></td>
                </tr>
                <tr>
                    <td align="right">パスワード</td>
                    <td>*********</td>
                </tr>
                <tr>
                    <td align="right">姓名（漢字）</td>
                    <td><?php echo $_POST['name_kanji']; ?></td>
                </tr>
                <tr>
                    <td align="right">姓名（かな）</td>
                    <td><?php echo $_POST['name_kana']; ?></td>
                </tr>
                <tr>
                    <td align="right">性別</td>
                    <td>
                        <?php if ($_POST['sex'] == 1) { echo '男性'; } else { echo '女性'; } ?>
                    </td>
                </tr>
                <tr>
                    <td align="right">生年月日</td>
                    <td>
                        <?php echo $_POST['year']; ?>年
                        <?php echo $_POST['month']; ?>月
                        <?php echo $_POST['day']; ?>日
                    </td>
                </tr>
                <tr>
                    <td align="right">郵便番号</td>
                    <td>
                        <?php echo $_POST['postal1']; ?>-<?php echo $_POST['postal2']; ?>
                    </td>
                </tr>
                <tr>
                    <td align="right">都道府県</td>
                    <td>
                        <?php echo $xmpf_tbl[$_POST['xmpf']]; ?>
                    </td>
                </tr>
                <tr>
                    <td align="right">住所１</td>
                    <td>
                        <?php echo $_POST['postal1']; ?>
                    </td>
                </tr>
                <tr>
                    <td align="right">住所２</td>
                    <td>
                        <?php echo $_POST['postal2']; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="利用規約に同意して、登録します">
                    </td>
                </tr>
            </form>
        </table>
    </div>
</body>
</html>






