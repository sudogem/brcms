<?php
require( '../admin/coreclass.php' );
session_start();
// if user is not login..redirect him to login page 
if ( !isset($_SESSION['login'])) { 
	header('Location: ../index.php');
}
if (isset($_POST['upload'])){

}

print_r($_POST);
?>