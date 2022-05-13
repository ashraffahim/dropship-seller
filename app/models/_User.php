<?php

namespace models;

use libraries\Database;

class _User {
	
	private $db;

	public function __construct() {
		$this->db = new Database();
	}

	public function login($user, $pass) {
		$this->db->query('SELECT `id`, CONCAT(`s_first_name`, " ", `s_last_name`) AS `name`, `s_email` AS `email`, `s_country` AS `country` FROM `seller` WHERE `s_email` = :user AND `s_password` = :pass AND `s_status` = 1');
		$this->db->bind(':user', $user, $this->db->PARAM_STR);
		$this->db->bind(':pass', $pass, $this->db->PARAM_STR);

		return $this->db->single();
	}

	public function availability($data) {

		$this->db->query('SELECT `id` AS `exists` FROM `seller` WHERE `s_email` = :data');
		$this->db->bind(':data', ($data['email']), $this->db->PARAM_STR);

		return $this->db->single();
	
	}

	public function setTemp($data) {
		if (!isset($_SESSION['tmp_email'])) {
			$_SESSION['tmp_first_name'] = $data['first_name'];
			$_SESSION['tmp_last_name'] = $data['last_name'];
			$_SESSION['tmp_email'] = $data['email'];
			$_SESSION['tmp_password'] = $data['password'];
			$this->sendVCode();
		}
	}

	public function setVCode() {
		$_SESSION['tmp_vcode_attempt'] = 0;
		$_SESSION['tmp_vcode'] = rand(100000,999999);
	}

	public function verify($code) {
		if ($code['vcode'] == $_SESSION['tmp_vcode']) {
			return $this->signup();
		} else {

			// Renew verification code
			if ($_SESSION['tmp_vcode_attempt'] > 5) {
				$this->sendVCode();
				return [
					'card-tag' => [
						'type' => 'danger',
						'body' => '<i data-feather="alert-octagon"></i><b class="ml-2">Too many attempts!</b> Please enter the new verification code.'
					]
				];
			}

			// Log attempt
			$_SESSION['tmp_vcode_attempt']++;
			return [
				'card-tag' => [
					'type' => 'warning',
					'body' => '<i data-feather="alert-circle"></i><b class="ml-2">Incorrect code!</b> Try again.'
				]
			];
		}
	}

	public function sendVCode() {

		$this->setVCode();

		//mail($_SESSION['tmp_user_email'], 'Menu Verification', $_SESSION['tmp_user_vcode']);
		$this->db->mail($_SESSION['tmp_email'], 'Confrim Signup', "<h3>{$_SESSION['tmp_vcode']}</h3>", '');
	}

	public function resendVCode() {
		$this->db->mail($_SESSION['tmp_email'], 'Confrim Signup', "<h3>{$_SESSION['tmp_vcode']}</h3>", '');
	}

	public function clearTmp() {
		unset($_SESSION['tmp_first_name']);
		unset($_SESSION['tmp_last_name']);
		unset($_SESSION['tmp_email']);
		unset($_SESSION['tmp_password']);
		unset($_SESSION['tmp_vcode']);
		unset($_SESSION['tmp_vcode_attempt']);
	}

	public function signup() {

		if (isset($this->availability(['email' => $_SESSION['tmp_email']])->exists)) {
			return [
				'success' => false,
				'card-tag' => [
					'type' => 'danger',
					'body' => 'Email exists. Contact admin if password needs to be changed.'
				]
			];
		}


		$this->db->query('INSERT INTO `seller` (`s_first_name`, `s_last_name`, `s_password`, `s_email`, `s_status`, `s_timestamp`, `s_latimestamp`) VALUES (:first_name, :last_name, :password, :email, 1, "' . time() . '", "' . time() . '")');
		$this->db->bind(':first_name', $_SESSION['tmp_first_name'], $this->db->PARAM_STR);
		$this->db->bind(':last_name', $_SESSION['tmp_last_name'], $this->db->PARAM_STR);
		$this->db->bind(':password', md5($_SESSION['tmp_password']), $this->db->PARAM_STR);
		$this->db->bind(':email', $_SESSION['tmp_email'], $this->db->PARAM_STR);

		$this->db->execute();

		return [
			'success' => true,
			'card-tag' => [
				'type' => 'success',
				'body' => 'Signup complete! Awaiting confirmation.'
			]
		];
	
	}

	public function profile($id) {
		$this->db->query('SELECT * FROM (' . $this->db->view('user') . ') `seller` WHERE `id` = :id');
		$this->db->bind(':id', $id, $this->db->PARAM_INT);
		return $this->db->single();
	}

	public function profileUpdate($data, $file, $id) {
		
		$emailAvaiability = $this->availability(['email' => $data['email']]);
		$emailAvaiability = isset($emailAvaiability->exists) ? $emailAvaiability->exists : false;

		if ((bool) $emailAvaiability && $emailAvaiability != $id) {
			return [
				'card-tag' => [
					'type' => 'warning',
					'body' => '<b>Email is in use!</b> Please check again'
				]
			];
		}

		if ($file['tmp_name'] != '') {

			if ($file['error'] == 0 && in_array(pathinfo($file['name'])['extension'], ['jpg', 'jpeg', 'png', 'gif', 'webp', 'jfif', 'svg'])) {
				
				$ext = pathinfo($file['name'])['extension'];

				$originalImage = $file['tmp_name'];
				$outputImage = DATADIR . DS . 'operator' . DS . $id . '.jpg';
				$quality = 75;

				$this->db->convertImageToJPG($originalImage, $outputImage, $ext, $quality);

			} else {
				return [
					'card-tag' => [
						'type' => 'danger',
						'body' => 'The file you\'ve uploaded is <b>corrupted</b>'
					]
				];
			}

		}

		$this->db->query('UPDATE `seller` SET `s_first_name` = :first_name, `s_last_name` = :last_name, `s_email`= :email WHERE `id` = :id');
		$this->db->bind(':first_name', $data['first_name'], $this->db->PARAM_STR);
		$this->db->bind(':last_name', $data['last_name'], $this->db->PARAM_STR);
		$this->db->bind(':email', $data['email'], $this->db->PARAM_STR);
		$this->db->bind(':id', $id, $this->db->PARAM_INT);

		$this->db->execute();

		return [
			'toast' => [
				'title' => 'Profile',
				'icon' => 'user',
				'body' => 'Your profile is updated'
			],
			'reload' => '#content'
		];

	}

	public function changePassword ($data, $id) {

		$this->db->query('SELECT `id` AS `verify` FROM `operator` WHERE `id` = :id AND `o_password` = :pass');
		$this->db->bind(':id', $id, $this->db->PARAM_INT);
		$this->db->bind(':pass', md5($data['old_password']), $this->db->PARAM_STR);

		if (isset($this->db->single()->verify)) {
			
			if ($data['new_password'] === $data['confirm_password']) {
				$this->db->query('UPDATE `operator` SET `o_password` = :pass WHERE `id` = :id');
				$this->db->bind(':pass', md5($data['new_password']), $this->db->PARAM_STR);
				$this->db->bind(':id', $id, $this->db->PARAM_INT);

				$this->db->execute();

				return [
					'toast' => [
						'title' => 'Password Change',
						'icon' => 'key',
						'body' => 'Password change was successful'
					],
					'form' => [
						'reset' => true
					]
				];
			} else {
				return [
					'toast' => [
						'title' => 'Password Change',
						'icon' => 'key',
						'body' => '<b>New Password</b> and <b>Confirm Password</b> did not match, try again'
					]
				];
			}

		} else {
			return [
				'toast' => [
					'title' => 'Password Change',
					'icon' => 'key',
					'body' => '<b>Old Password</b> was incorrect'
				]
			];
		}

	}

}

?>