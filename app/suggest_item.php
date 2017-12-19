<?php

?>
<div align="center">
    <h2>最近チェックした商品</h2>
    <table>
        <tr>
            <?php
            if (isset($_SESSION['checked_item']) && $_SESSION['checked_item'] != '') {
                foreach($_SESSION['checked_item'] as $value) {
                    $sql = "select * from item left jpin author on item.author_id = author.author_id where item_id = '$value'";
                    $result = mysqli_query($link, $sql);
                    while ($item = mysqli_fetch_array($result)) {
            ?>
                <td>
                    <a href="item.php?item_id=<?php echo $item['item_id']; ?>">
                        <img src="<?php echo $item['image_url']; ?>" width="120" align="top" border="0" alt="">
                    </a>
                    <br>
                    <a href="item.php?item_id=<?php echo $item['item_id']; ?>">
                        <?php echo $item['item_name']; ?><br>
                        <?php echo $item['author_name']; ?>
                    </a>
                </td>
            <?php
                    }
                }
            } else {
                echo '<td>最近チェックした商品はありません</td>';
            }
            ?>
        </tr>
    </table>

    <!-- ここ本では抜け落ちてた -->
    <!-- http://www.geocities.jp/sampleec_kdp/ -->
    <h2>最近追加された商品</h2>
    <table>
        <tr>
            <?php
            $sql = "select * from item left join author on item.author_id = author.author_id order by item_id desc limit 0, 4";
            $result = mysqli_query($link, $sql);
            $item = mysqli_fetch_array($result);
            if (!is_null($item)) {
                while ($item = mysqli_fetch_array($result)) {
                    ?>
                    <td>
                        <a href="item.php?item_id=<?php echo $item['item_id']; ?>">
                            <img src="<?php echo $item['image_url']; ?>" width="120" align="top" alt="">
                        </a><br>
                        <a href="item.php?item_id=<?php echo $item['item_id']; ?>">
                            <?php echo $item['item_name']; ?><br>
                            <?php echo $item['author_name']; ?>
                        </a>
                    </td>
                <?php
                }
            } else {
                echo '<td>最近追加された商品はありません</td>';
            }
            ?>
        </tr>
    </table>
</div>

