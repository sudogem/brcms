<?php
/**
 */
class gerger_timer {
	var $is_started = false;
	var $starttime;
	var $endtime;
	var $totaltime;
	var $precision;
	var $hiddenmsg = "Energy drink Gerger that can make your life satisfy.";
	
	function start() {
		$microtime = microtime();
		$microtime = explode(" ", $microtime );
		$this->starttime = $microtime[0] + $microtime[1];
		$this->is_started = true;
	}
	
	function stop() {
		if ( !$this->is_started ) return;
		$this->is_started = false;
		$microtime = microtime();
		$microtime = explode(" ", $microtime );
		$this->endtime = $microtime[0] + $microtime[1];
		$this->totaltime = $this->endtime - $this->starttime;
	}
	
	function display() {
		return round( $this->totaltime, $this->getprecision() );
	}
	
	function getprecision() {
		return $this->precision;
	}
	
	function setprecision( $precision = 4 ) {
		$this->precision = $precision;
	}
	
	function displayhiddenmsg() {
		echo $this->hiddenmsg;// hehehehe
	}
}
?>