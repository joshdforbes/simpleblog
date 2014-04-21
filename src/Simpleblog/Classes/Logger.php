<?php
namespace Simpleblog\Classes;

class Logger 
{
	/**
	 * writes an error message to the log file specified by ERROR_LOG_PATH
	 * @param  string $message the error message
	 */
	public static function log($message)
	{
	    $date = date('d m Y h:i:s'); 
		$log = $message."   |  Date:  ".$date."\n"; 
		error_log($log, 3, ERROR_LOG_PATH); 
	}

}