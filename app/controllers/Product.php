<?php

namespace controllers;

use libraries\Controller;
use models\_Product;

class Product extends Controller {

	private $p;

	function __construct() {
		$this->p = new _Product();
	}

	public function add() {
		$this->requireLogin();
		if ($this->RMisPost()) {
			$this->sanitizeInputPost();
			$this->p->create($_POST, $_FILES);
		}
		$this->view('product' . DS . 'add');
	}

	public function index() {
		$this->requireLogin();
		$data = $this->p->list();
		$this->view('product/index', ['l' => $data]);
	}
}

?>