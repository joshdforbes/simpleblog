<?php
namespace Simpleblog\View;


class View
{
	/**
	 * holds the data used by the template
	 * 
	 * @var array
	 */
	protected $data = array();

	public function __construct() {}

	/**
	 * sets data to be used in the template file
	 * 
	 * @param sting $name the name used by the template
	 * @param string $value the data associated with the name
	 */
	public function set($name, $value)
	{
		$this->data[$name] = $value;
	}

	/**
	 * outputs the specified template to the browser
	 * 
	 * @param  string $template html 
	 * 
	 * @return string the contents of the output buffer
	 *
	 * @throws Exception If the file is not found then it calls errorController 
	 * with the notFound action
	 */
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