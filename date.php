<?php
/*
$d = '2005-12-22 04:33:18';
$x = date( 'F j, Y, g:i a' , $d);
$cc= strftime('%m/%d/%y ', $d);
echo $cc;
echo $x;

*/
/*
$t = time();
$d = date( 'F j, Y, g:i:s a', $t );
//January 12, 2006, 12:07:02 pm
$m = date( 'n', $t);
$d = date( 'j', $t);
$y = date( 'Y', $t);
$t = date( 'g:i:s a', $t);
echo "m= $m";
echo "d=$d";
echo "y=$y";
echo "t=$t";
*/
$x = date('F', 2);
//echo "x=$x";
session_start();
print session_id();
?>