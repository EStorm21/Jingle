<?php

// Carrier email suffixes
define("ATT",                 "txt.att.net");
define("SPRINT",              "messaging.sprintpcs.com");
define("TMOBILE",             "tmomail.net");
define("US_CELLULAR",         "email.uscc.net");
define("VERIZON",             "vtext.com");
define("VIRGIN_MOBILE",       "vmobl.com");


// Message parameters
define("MAX_SMS_LENGTH",       140);
define("DEFAULT_CELL_SENDER",  "my.email.@yahoo.com");

//$num = 09123456789;
//$car = "ATT";
//$mssg = "Hello World!";
//$cellphone = new Cell();
//$cellphone = mail($num, $car, $mssg);


class Cell
{
	public static function send($pNumber, $pCarrier, $pMessage)
	{
		// Keep a notifier of whether the message was sent or not
		$Success = true;
		
		// Define the recipient address
		$Recipient = $pNumber . "@" . $pCarrier;
		
		// Find out how many message will have to be sent
		$MessageCount = ceil(strlen($pMessage) / MAX_SMS_LENGTH);
		
		for ($i = 0; $i < $MessageCount; $i++)
		{
			// Calculate the subset of the entire message that can be sent at once
			$StartIndex = $i * MAX_SMS_LENGTH;
			$Message = stripslashes(substr($pMessage, $StartIndex, MAX_SMS_LENGTH));
			
			// Display page numbers on messages that span multiple iterations
			if ($MessageCount > 1)
			{
				$Message .= " (" . ($i + 1) . "/" . $MessageCount . ")";
			}
			
			// Send the message
			$Success &= mail($Recipient, null, $Message, "From: " . DEFAULT_CELL_SENDER);
		}
		
		return $Success;		
	}
}

//Cell::send("9522206081", SPRINT, "Jingle Jingle Jingle! That was easy.");

?>
