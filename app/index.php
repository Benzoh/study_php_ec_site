<?php

require('config.php');
require('lib.php');

session_start();

// db_connect
$link = mysqli_connect($db_host, $db_user, $db_password, $db_name);
$result = mysqli_query($link, 'set character set utf8');

require('header.php');
require('topbar.php');
require('suggest_item.php');
require('footer.php');





