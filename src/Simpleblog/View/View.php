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
		$path = $_SERVER['DOCUMENT_ROOT'] . '/assets/templates/' . $template;
		if (file_exists($path)){
			ob_start();
			require($path);
			return ob_get_clean();
		} else {
			Throw new \Exception('Template not found');
		}
		
	}


}