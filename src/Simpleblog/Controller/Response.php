<?php
namespace Simpleblog\Controller;

class Response
{
	private $content;
	private $status;
	private $headers;

	private static $statusCodes = array(
		200 => '200 Ok',
		404 => '404 Not Found'
	);
	
	public function __construct($content = '', $status = 200, $headers = array())
	{
		$this->content = $content;
		$this->status = $status;
		$this->headers = $headers;
	}

	public function setContent($content)
	{
		$this->content .= $content;
		return $this;
	}

	public function setStatus($status)
	{
		$this->$status = $status;
		return $this;
	}

	public function addHeader($header)
	{
		$this->headers[] = $header;	
		return $this;
	}


	public function send()
	{
		header('Status: ' . isset(static::$statusCodes[$this->status]) ? static::$statusCodes[$this->status] : $this->status);
		foreach ($this->headers as $header) {
			header($header);
		}
		echo $this->content;
		exit();
	}

}