<?php
namespace Simpleblog\Controller;

class Response
{
	/**
	 * the content to be sent to the browser
	 * 
	 * @var string
	 */
	private $content;

	/**
	 * the status code of the response
	 * 
	 * @var integer
	 */
	private $status;

	/**
	 * headers to be sent
	 * 
	 * @var array
	 */
	private $headers;

	/**
	 * mapping status codes to status message
	 * 
	 * @var array
	 */
	private static $statusCodes = array(
		200 => '200 Ok',
		404 => 'HTTP/1.0 404 Not Found',
		500 => 'HTTP/1.0 500 Internal Server Error'
	);
	
	/**
	 * construct
	 * 
	 * @param string  $content 
	 * @param integer $status 
	 * @param array   $headers
	 */
	public function __construct($content = '', $status = 200, $headers = array())
	{
		$this->content = $content;
		$this->status = $status;
		$this->headers = $headers;
	}

	/**
	 * set the content
	 *
	 * @param string $content
	 * @return $this
	 */
	public function setContent($content)
	{
		$this->content .= $content;
		return $this;
	}

	/**
	 * set the status
	 *
	 * @param integer $status
	 * @return $this
	 */
	public function setStatus($status)
	{
		$this->status = $status;
		return $this;
	}

	/**
	 * add a header to the header array
	 *
	 * @param string $header a single header to be added to the array
	 * @return $this
	 */
	public function addHeader($header)
	{
		$this->headers[] = $header;	
		return $this;
	}

	/**
	 * sends the header, status, and content to the browser using echo
	 * if the integer is $status matches a value in the $statusCode array that value is sent
	 * otherwise sends the raw status code to the browser
	 * 
	 * @return void
	 */
	public function send()
	{
		header('Status: ' . isset(self::$statusCodes[$this->status]) ? self::$statusCodes[$this->status] : $this->status);
		foreach ($this->headers as $header) {
			header($header);
		}
		echo $this->content;
		exit();
	}

}