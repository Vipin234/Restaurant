<?php 
session_start();
$destroy = session_destroy();
if($destroy == TRUE)
{
header("Location: login.php");
}
?>