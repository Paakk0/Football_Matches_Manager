<?php
require_once '../session.php';
require_once '../actions/helper_functions.php';

Session::start();
Session::destroy();

redirect('../pages/home.php');
?>