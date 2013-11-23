<?php

class Logger 
{
	private $logFile;

	function __construct() 
	{
		$this->logFile = '..logs/log_'.date('Ymd').'.txt';
	}

	function log($message)
	{
		$fp = fopen($this->logFile, 'a+');
		
		$message = date('Y m d h:i:s').'\t'.$message.'\n';

		fwrite($fp, $message);
		fclose($fp);
	}


}