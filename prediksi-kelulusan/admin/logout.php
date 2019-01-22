<?php

/**
 * @Author: Rick
 * @Date:   2018-01-19 01:11:23
 * @Last Modified by:   Rick
 * @Last Modified time: 2018-01-19 01:14:10
 */

session_start();
$_SESSION = [];
session_unset();
session_destroy();

header("Location:login.php");