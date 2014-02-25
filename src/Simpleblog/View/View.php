<?php
namespace Simpleblog\View;


class View
{
	public $data = array();

	public function __construct($template)
	{
		$this->template = $template;
	}

	public function set($name, $value)
	{
		$this->data[$name]=$value;
	}

	public function render() {
		require($this->template);
	}


}