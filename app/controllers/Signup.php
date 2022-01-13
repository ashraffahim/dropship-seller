<?php

namespace controllers;

use libraries\Controller;
use models\_Country;
use models\_User;

class Signup extends Controller {

	private $u;

	function __construct() {
		$this->u = new _User();
	}

	public function index()	{
		$r = [];
		$c = new _Country();
		if ($this->RMisPost()) {
			$this->sanitizeInputPost();
			if (isset($_POST['email'])) {
				$this->u->setTmp($_POST);
			} elseif (isset($_POST['vcode'])) {
				$r = $this->u->verify($_POST);
				header('Location: /');
			}
		}
		$this->view('signup', [
			'country' => $c->list(),
			'status' => $r,
			'verify' => isset($_SESSION['tmp_user_vcode'])
		], false, false);
	}

	public function clear() {
		$this->u->clearTmp();
		header('Location: /signup');
	}
}

?>