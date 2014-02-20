<?php
class Output 
{
	public $data = array();

	public function printObject()
	{
		echo "{";
		foreach($this->data as $key => $value) {
			echo $key . ":" . $value . "|";
		}
		echo "}";
	}

	public function pushElement($key, $val) 
	{
		if (array_key_exists($key, $this->data)) {
			$this->data[$key] = $this->data[$key] . ";" . $val;
		} else {
			$this->data[$key] = $val;
		}
	}
}
?>
