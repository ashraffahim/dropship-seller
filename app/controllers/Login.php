<?php

namespace controllers;

use libraries\Controller;
use models\_User;
use models\_Country;

class Login extends Controller {

	private $user;

	function __construct() {
		$this->user = new _User();
	}
	
	public function index() {

		$c = new _Country();

		$data = [
			'co' => $c->codeName(),
			'cr' => $c->currencySymbol()
		];

		if ($this->RMisPost()) {

			$this->sanitizeInputPost();
			$user_id = $this->user->login($_POST['user'], md5($_POST['pass']));

			if ($user_id) {
				
				$_SESSION[CLIENT . 'user_id'] = $user_id;
				redir('/');

			} else {

				$data = [
					'error' => 'Invalid credentials',
					'redir' => '/login/index',
					'co' => $c->codeName(),
					'cr' => $c->currencySymbol()
				];

			}
		
		}

		if (!isset($_SESSION[CLIENT . 'user_id'])) {

			$this->view('login', $data, false);
		
		} else {

			redir('/home/index');

		}

	}

	public function availability() {

		if ($this->RMisPost()) {

			$this->sanitizeInputPost();
			$data = $this->user->availability($_POST);

			if (isset($data->exists)) {
				$this->status(['status' => 1]);
			} else {
				$this->status(['status' => 0]);
			}

		}

	}

	public function signup() {

		if ($this->RMisPost()) {

			$this->sanitizeInputPost();
			if (isset($_POST['email'])) {
				$status = $this->user->setTemp($_POST);
			} elseif (isset($_POST['vcode'])) {
				$status = $this->user->verify($_POST);
				// $this->status($status);
			}


			if ($status['success']) {
				$user_id = $this->user->login($_SESSION['tmp_email'], md5($_SESSION['tmp_password']));
				if ($user_id) {
					
					$_SESSION[CLIENT . 'user_id'] = $user_id;
					$this->user->clearTmp();
					redir('/');

				}
			}

			$this->view('login', ['status' => $status], false);
			
		} else {
			$this->view('login', [], false);
		}

	}

	public function clearTmp() {
		$this->user->clearTmp();
		redir('/login/index');
	}

	public function logout() {
		session_destroy();
		redir('/login/index');
	}

}

?>