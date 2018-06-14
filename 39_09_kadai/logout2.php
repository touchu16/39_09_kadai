<?php
session_start();

$_SESSION = array();

if(isset($_COOKIE[session_name()])){
    setcookie(session_name(),'',time()-42000, '/');
}


session_destory();
header("Location: login2.php");
exit();

?>