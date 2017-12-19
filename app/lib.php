<?php

require('config.php');

// var_dump($db_host);

function db_connect() {
    global $db_host, $db_user, $db_password, $db_name;
    $link = mysqli_connect($db_host, $db_user, $db_password, $db_name);
    return $link;
}

function auth() {
    global $magic_code;

    if (isset($_SESSION['login_id']) && md5($magic_code . $_SESSION['login_id']) == $_SESSION['auth_code']) {
        return true;
    } else {
        // setcookie(session_name(), '', 0);
        // session_destroy();
        return false;
    }
}

function make_category($parent_id, $order, $sort, $value, $indent) {
    // var_dump($parent_id, $order, $sort, $value, $indent);

    // TODO: これよろしくない気がする
    // global $db_host, $db_user, $db_password, $db_name;
    // $link = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    $link = db_connect();

    $sql = "select * from category where parent_id = '$parent_id' and category_id >= 0 order by '$order' $sort";
    $result = mysqli_query($link, $sql);
    // var_dump($result);

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