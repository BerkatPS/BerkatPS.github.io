<?php
require_once('../connection/conf.php');


session_start();
session_unset();
session_destroy();
unset($_SESSION);

header('Location: login?act=logout');
?>