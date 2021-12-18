<?php

namespace controllers;

use libraries\Controller;

class Logout extends Controller {

	function __construct() {
		session_destroy();
		header('Location: ./');
	}

	public function index()	{
	}
}

?>