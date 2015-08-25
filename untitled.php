<?php 
$s = md5("21232f297a57a5a743894a0e4a801fc3");
//echo $s;
/*echo strtotime("now"), "\n";
echo strtotime("10 September 2000"), "\n";
echo strtotime("+1 day"), "\n";
echo strtotime("+1 week"), "\n";
echo strtotime("+1 week 2 days 4 hours 2 seconds"), "\n";
echo strtotime("next Thursday"), "\n";
echo strtotime("last Monday"), "\n";
*/
$x =  strtotime("Mar 21 2006 ");
echo $x;
echo date("D F j, Y, g:i a"      ,$x          );                 
?>