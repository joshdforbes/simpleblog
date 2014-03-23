<?php
namespace Simpleblog\Controller;

class ErrorController
{
	private $parameters;

	public function __construct($parameters)
	{
		$this->parameters = $parameters;
	}

	public function notFoundAction()
	{
		echo 'Page Not Found';
		return $this;
	}

	public function databaseErrorAction()
	{
		echo 'An internal error occured, please try your request again';
		return $this;
	}
}