<?php 
function ___time($request) {
	global $OUT;
	//$OUT->pushElement('test', 'tesst');
	//echo time();
	return time();
}

function ___text($request) {
	 $text = explode(",", $request);
	if (count($text) > 1) {
		$message = $text[1];
	} else {
		$message = "Check your calendar!";
	}
	include('cell.php');
	Cell::send("9522206081", SPRINT, urldecode($message));
	return 1;
}
?>
