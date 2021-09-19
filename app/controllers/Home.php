<?php

namespace controllers;

use libraries\Controller;
use models\_Home;

class Home extends Controller {

	private $h;

	function __construct() {
		$this->h = new _Home();
	}

	public function index()	{
		$this->h->feed();
		$this->view('home'.DS.'feed');
	}
}

?>