<?php
include('functionDB.php');
$DATAPATH = '';
function getCurrentTime() {
	return time();
}

function logValue($id, $key, $value) {
	global $DATAPATH;
	$fileName = $DATAPATH . $id . '.' . $key;
	if ($file = fopen($fileName, 'a')) {
		fwrite($file, getCurrentTime() . ':' . $value . '|');
	}
}

//A query is structured as follows:
// query,[param1],[param2],[...];[query,[param1],[param2],[...];][...]
// A parameter is structured as key:value
function parseQuery($id, $query) {
	$queries = explode(";", $query);
	$result = "";
	foreach($queries as $request) {
		//separate parameters
		$values = explode(",", $request);
		$functionName = "___" . $values[0];
		if (function_exists($functionName)) {
			//We already have a function! Let's use it
			$result .= $values[0] . "~" . $functionName($request) . ";";
		}
	}
	return $result;

}
?>
