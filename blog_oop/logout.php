<?php
require_once('includes/bootstrap.php');
//session_start();
//session_destroy();
$session->logout();
header("Location: index1.php");