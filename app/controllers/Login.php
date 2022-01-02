<?php

namespace controllers;

use libraries\Controller;
use models\_User;

class Login extends Controller {

	private $u;

	function __construct() {
		$this->u = new _User();
	}

	public function index()	{
		$lr = [];
		if ($this->RMisPost()) {
			$this->sanitizeInputPost();
			$lr = $this->u->login($_POST['email'], $_POST['password']);
			if ($lr != false) {
				// Login & Redirect
				$_SESSION['uid'] = $lr->id;
				$_SESSION['ufn'] = $lr->s_first_name;
				$_SESSION['uln'] = $lr->s_last_name;
				$_SESSION['ue'] = $lr->s_email;
				header('Location: /');
			}
		}
		$this->view('login', ['status' => $lr], false, false);
	}
}

?>