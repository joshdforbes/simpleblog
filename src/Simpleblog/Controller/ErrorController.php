<?php
namespace Simpleblog\Controller;

class ErrorController
{
	public function __construct(){}

	public function notFoundAction($parameters)
	{
		echo $parameters;
		return $this;
	}
}