<?php 

if (!isset($path_test)) { die("Access denied"); }

session_start();
session_unset();
session_destroy();
header("Location: ?page=login");
exit();