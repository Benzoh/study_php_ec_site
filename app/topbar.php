<?php

?>

<div align="center">
    <table width="80%">
        <tr>
            <td><a href="<?php $site_url; ?>">Sample EC</a></td>
            <td align="right">
            <?php if ( auth() ): ?>
                こんにちわ <?php echo $_SESSION['name_kanji']; ?>さん
                [<a href="cart.php">カート</a>]
                [<a href="account.php">アカウント</a>]
                [<a href="logout.php">ログアウト</a>]
            <?php else: ?>
                [<a href="login.php">ログイン</a>]
                [<a href="register1.php">会員登録</a>]
            <?php endif; ?>
                [<a href="help.php">ヘルプ</a>]
            </td>
        </tr>
        <form action="result.php" method="get">
            <tr align="center">
                <td colspan="2">
                    |
                    <?php
                        $sql = "select * from category where parent_id = '0' order by category_name";
                        $result = mysqli_query($link, $sql);
                        while ($category = mysqli_fetch_array($result)) {
                            echo '<a href="result.php?category_id=' . $category['category_id'] . '">' . $category['category_name'] . '</a> |';
                        }
                    ?>
                    <select name="category_id">
                        <option value="">指定しない
                            <?php make_category(0, 'type, name', 'desc', $_GET['category_id'], ''); ?>
                        </option>
                    </select>
                    <input type="text" name="query" value="<?php echo $_GET['query']; ?>" size="32">
                        並び替え：
                    <select name="sort" id="">
                        <option value="item_name asc" <?php if ($_GET['sort'] == 'item_name asc') { echo 'selected'; } ?> >商品名の順：昇順</option>
                        <option value="item_name desc" <?php if ($_GET['sort'] == 'item_name desc') { echo 'selected'; } ?> >商品名の順：降順</option>
                        <option value="sale_price asc" <?php if ($_GET['sort'] == 'sale_price asc') { echo 'selected'; } ?> >価格の安い順</option>
                        <option value="sale_price desc" <?php if ($_GET['sort'] == 'sale_price desc') { echo 'selected'; } ?> >価格の高い順</option>
                        <option value="release_date asc" <?php if ($_GET['sort'] == 'release_date asc') { echo 'selected'; } ?> >発売日の古い順</option>
                        <option value="release_date desc" <?php if ($_GET['sort'] == 'release_date desc') { echo 'selected'; } ?> >発売日の新しい順</option>
                    </select>
                    <input type="submit" value="検索">
                </td>
            </tr>
        </form>
    </table>
</div>