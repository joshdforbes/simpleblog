<?php
namespace Simpleblog\Controller;

class ErrorController
{
	public function __construct(){}

	public function notFoundAction($parameters)
	{
		echo 'Not Found!';
		return $this;
	}
}