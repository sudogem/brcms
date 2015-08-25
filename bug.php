<?php
session_start();

$_SESSION['score'] = 100;

//print 'session score = '.$_SESSION['score'];

$score = $_SESSION['score'];
//$score = 0;
//print "<br>session score = $score";
$str = 1;
echo 'str='.$str;
$x = $str xor 2;
echo 'md5='.$x;
$y = $x ^ 2;
echo 'str='.$y;
?>