<?php

namespace controllers;

use libraries\Controller;
use models\_Product;

class Product extends Controller {

	private $p;

	function __construct() {
		$this->p = new _Product();
	}
	
	public function index() {
		$data = $this->p->index();
		$this->view('product/index', ['data' => $data]);
	}

	public function add() {
		if ($this->RMisPost()) {
			$this->sanitizeInputPost();
			$status = $this->p->add($_POST);
			if ($status['status']) {
				redir('/product');
			}
		}
		$this->view('product/add', []);
	}
}

?>