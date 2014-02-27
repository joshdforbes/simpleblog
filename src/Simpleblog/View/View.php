<?php
namespace Simpleblog\View;


class View
{
	public $data = array();

	public function __construct() {}

	public function set($name, $value)
	{
		$this->data[$name] = $value;
	}

	public function render($template) {
		require($template);
	}


}