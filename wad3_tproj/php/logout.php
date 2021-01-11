<?php

require_once 'include/common.php';

// 1) Remove all Session Variables registered so far
session_start();
$_SESSION = [];


// 2) Destroying the current session
session_unset();
session_destroy();


//header("Location: ../index.php");
echo true;
?>