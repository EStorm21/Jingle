<?php 
include('functions.php');
include('object.php');
$OUT = new Output();
//$OUT->pushElement('action', 'rollover');
//$OUT->pushElement('fii', 'woo');
//$OUT->pushElement('action', 'spin');
foreach ($_GET as $key => $value) {
	//echo $key . ' => ' . $value;
	if ($key == 'id') {
	} else if ($key == 'query') {
		$OUT->pushElement('queryResponse', parseQuery($_GET['id'], $value));
	} else if ($key == 'action') {
		$OUT->pushElement('actionResponse', parseQuery($_GET['id'], $value));
	} else {
		logValue($_GET['id'], $key, $value);
	}
}
//$OUT->printObject();
if (!isset($_GET['id'])) {
	include('display.php');
} else {
	$OUT->printObject();
}

?>
