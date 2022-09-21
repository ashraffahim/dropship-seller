<?php

namespace controllers;

use libraries\Controller;
use models\_User;

class User extends Controller {

	private $user;

	function __construct() {
		$this->user = new _User();
	}

	public function add() {
		$this->view('user/add');
	}

	public function profile($t = false, $id = false) {

		switch ($t) {
			case false: {
				$id = !$id ? $_SESSION[CLIENT . 'user_id']->id : $id;

				if ($this->RMisPost()) {
					$this->sanitizeInputPost();
					$status = $this->user->profileUpdate($_POST, $_FILES['image'], $_SESSION[CLIENT . 'user_id']->id);
					$this->status($status);
				}

				$data = $this->user->profile($id);
				$this->view('user/profile', [
					'id' => $id,
					'uid' => $_SESSION[CLIENT . 'user_id']->id,
					'data' => $data
				]);
			} break;

			case 'remove-profile-image': {
				$this->removeProfileImage();
			} break;

			case 'change-password': {
				$this->changePassword();
			} break;
		}
	
	}

	public function removeProfileImage() {
		unlink(DATA . 'dp_' . $_SESSION[CLIENT . 'user_id']->id . '.jpg');
		redir('/user/profile');
	}

	public function changePassword() {
		if ($this->RMisPost()) {
			$this->sanitizeInputPost();

			$status = $this->user->changePassword($_POST, $_SESSION[CLIENT . 'user_id']->id);
			$this->status($status);
		}
	}

}

?>