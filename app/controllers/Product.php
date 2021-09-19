<?php

namespace controllers;

use libraries\Controller;
use models\_Product;

class Product extends Controller {

	private $p;

	function __construct() {
		$this->p = new _Product();
	}

	public function details($p) {
		$pd = $this->p->details($p);
		$this->view('product' . DS . 'detail', ['data' => $pd]);
	}
}

?>