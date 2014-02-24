<?php
namespace Simpleblog\View;


class View
{
	public function __construct($template, $data)
	{
		$this->template = $template;
		$this->data = $data;
	}

	public function render() {
		require($this->template);
	}


}