<?php
require('xmpf_tbl.php');
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sample EC - 会員登録[1/4]</title>
</head>
<body>
    <div align="center">
        Sample EC - 会員登録[1/4]<br>
        <br>
        <small><font color="red">*</font>は必須項目です</small>
        <table>
            <form action="register2.php" method="post">
                <tr>
                    <td align="right">メールアドレス <font color="red">*</font></td>
                    <td><input type="text" name="email1" size==48 maxlength=64></td>
                </tr>
                <tr>
                    <td align="right">メールアドレスの確認<font color="red">*</font></td>
                    <td><input type="text" name="email12" size==48 maxlength=64></td>
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
                    <td><input type="text" name="name_kanji" size=48 maxlength=32></td>
                </tr>
                <tr>
                    <td></td>
                    <td><small>半角32文字まで（例）大阪太郎</small></td>
                </tr>
                <tr>
                    <td align="right">姓名（かな）<font color="red">*</font></td>
                    <td><input type="text" name="name_kana" size=48 maxlength=32></td>
                </tr>
                <tr>
                    <td></td>
                    <td><small>半角32文字まで（例）おおさかたろう</small></td>
                </tr>
                <tr>
                    <td align="right">性別</td>
                    <td>
                        <input type="radio" name="sex" value=1 checked>男性
                        <input type="radio" name="sex" value=2 checked>女性
                    </td>
                </tr>
                <tr>
                    <td align="right">生年月日</td>
                    <td>
                        <select name="year" id="">
                            <?php for($n = 1905; $n <= 2018; $n++) echo "<option value=$n>$n\n"; ?>
                        </select>年
                        <select name="month" id="">
                            <?php for($n = 1; $n <= 12; $n++) echo "<option value=$n>$n\n"; ?>
                        </select>月
                        <select name="day" id="">
                            <?php for($n = 1; $n <= 31; $n++) echo "<option value=$n>$n\n"; ?>
                        </select>日<br>
                    </td>
                </tr>
                <tr>
                    <td align="right">郵便番号 <font color="red">*</font></td>
                    <td>
                        <input type="text" name="postal1" size="5" maxlength="5">
                        <input type="text" name="postal2" size="6" maxlength="6">
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
                            <?php foreach($xmpf_tbl as $key => $value) echo "<option value=$key>$value\n"; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="right">住所１<font color="red">*</font></td>
                    <td><input type="text" name="address1" size="48" maxlegnth="64"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><small>半角64文字まで（例） 千代田区0-0-0</small></td>
                </tr>
                <tr>
                    <td align="right">住所２</td>
                    <td><input type="text" name="address2" size="48" maxlength="64"></td>
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
</body>
</html>