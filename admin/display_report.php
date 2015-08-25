<?php
include( 'configuration.php' );
include('create_graphs.php');
session_start();
$from_date = $_SESSION['from_date'];
$end_date = $_SESSION['end_date2'];
create_usage_graph($from_date, $end_date);
?>