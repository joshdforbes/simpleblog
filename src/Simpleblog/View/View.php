<?php
namespace Simpleblog\View;


class View
{
	protected $data = array();

	public function __construct() {}

	public function set($name, $value)
	{
		$this->data[$name] = $value;
	}

	public function render($template) {
		$templatePath = $_SERVER['DOCUMENT_ROOT'] . '/assets/templates/' . $template;
		$mainTemplatePath = $_SERVER['DOCUMENT_ROOT'] . '/assets/templates/mainTemplate.php';
		if (file_exists($templatePath)){
			ob_start();
			require($mainTemplatePath);
			return ob_get_clean();
		} else {
			Throw new \Exception('notFound');
		}
		
	}


}