<?php

class Logger 
{
	public static function log($message)
	{
	    $date = date('d m Y h:i:s'); 
		$log = $msg."   |  Date:  ".$date."  |  User:  ".$username."\n"; 
		error_log($log, 3, ERROR_LOG_PATH); 
	}

}