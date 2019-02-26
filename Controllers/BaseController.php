<?php

namespace Controllers;

abstract Class BaseController {

	public function render($file) {
	    require_once ROOT . '/' . $file .'.php';
    }
}