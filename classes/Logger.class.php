<?php

class Logger 
{
	public static function log($message)
	{
	    $date = date('d m Y h:i:s'); 
		$log = $message."   |  Date:  ".$date."\n"; 
		error_log($log, 3, ERROR_LOG_PATH); 
	}

}