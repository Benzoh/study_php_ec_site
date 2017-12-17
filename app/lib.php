<?php

function auth() {
    global $magic_code;

    if (md5($magic_code . $_SESSION['login_id']) == $_SESSION['auth_code']) {
        return true;
    } else {
        // setcookie(session_name(), '', 0);
        // session_destroy();
        return false;
    }
}

function make_category($parent_id, $order, $sort, $value, $indent) {
    $sql = "select * from category where parent_id = '$parent_id' and category_id >= 0 order by '$order' $sort";
    $result = mysqli_query($link, $sql);

    while ($category = mysqli_fetch_array($result)) {
        if ($category['category_id'] == $value) {
            echo '<option value="' . $category["category_id"] . '" selected>' . $indent . $category['category_name'] . '\n';
        } else {
            echo '<option value="' . $category['category_id'] . '">' . $indent . $category['category_name'] . '\n';
        }
        // 再帰呼び出し
        make_category($category['category_id'], $order, $sort, $value, $indent . '&nbsp;');
    }
}