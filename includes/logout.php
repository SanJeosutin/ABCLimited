<?php if (session_status() == PHP_SESSION_NONE) session_start();
/*********************************************
 *? NAME        : SanJeosutin
 *? TITLE       : logout.php
 *? DESCRIPTION : logout script
 *? CREATED ON  : 25-10-2019
 *********************************************/

session_unset();
session_destroy();

header("location: ../index.php");

exit();
?>