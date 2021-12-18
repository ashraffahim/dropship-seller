<?php

namespace models;

use libraries\Database;

class _User {

	private $db;

	function __construct() {
		$this->db = new Database();
	}

	public function setTmp($d) {
		if (!isset($_SESSION['tmp_user_email'])) {
			$_SESSION['tmp_user_first_name'] = $d['first_name'];
			$_SESSION['tmp_user_last_name'] = $d['last_name'];
			$_SESSION['tmp_user_email'] = $d['email'];
			$_SESSION['tmp_user_phone'] = $d['phone'];
			$_SESSION['tmp_user_country'] = $d['country'];
			$_SESSION['tmp_user_password'] = $d['password'];

			$this->sendVCode();
		}
	}

	public function verify($vc) {
		if ($vc['vcode'] == $_SESSION['tmp_user_vcode']) {
			$this->create();
		} else {

			// Renew verification code
			if ($_SESSION['tmp_vcode_attempt'] > 5) {
				$this->sendVCode();
				return [
					'alrt' => [
						't' => 'danger',
						'b' => '<i data-feather="alert-octagon"></i><b class="ml-2">Too many attempts!</b> Please enter the new verification code.'
					]
				];
			}

			// Log attempt
			$_SESSION['tmp_vcode_attempt']++;
			return [
				'alrt' => [
					't' => 'warning',
					'b' => '<i data-feather="alert-circle"></i><b class="ml-2">Incorrect code!</b> Try again.'
				]
			];
		}
	}

	public function create() {
		$this->db->query('INSERT INTO `user` (`u_first_name`, `u_last_name`, `u_email`, `u_password`, `u_phone`, `u_country`, `u_timestamp`, `u_latimestamp`) VALUES (:fn, :ln, :e, :p, :pn, :c, "' . time() . '", "' . time() . '")');
		$this->db->bind(':fn', $_SESSION['tmp_user_first_name'], $this->db->PARAM_STR);
		$this->db->bind(':ln', $_SESSION['tmp_user_last_name'], $this->db->PARAM_STR);
		$this->db->bind(':e', $_SESSION['tmp_user_email'], $this->db->PARAM_STR);
		$this->db->bind(':p', md5($_SESSION['tmp_user_password']), $this->db->PARAM_STR);
		$this->db->bind(':pn', $_SESSION['tmp_user_phone'], $this->db->PARAM_STR);
		$this->db->bind(':c', $_SESSION['tmp_user_country'], $this->db->PARAM_STR);
		$this->db->execute();

		// Login & Redirect
		$_SESSION['uid'] = $this->db->lastInsertId();
		$_SESSION['ufn'] = $_SESSION['tmp_user_first_name'];
		$_SESSION['uln'] = $_SESSION['tmp_user_last_name'];
		$_SESSION['ue'] = $_SESSION['tmp_user_email'];
	}

	public function sendVCode() {
		$_SESSION['tmp_vcode_attempt'] = 0;
		$this->setVCode();

		//mail($_SESSION['tmp_user_email'], 'Menu Verification', $_SESSION['tmp_user_vcode']);
		$this->db->mail($_SESSION['tmp_user_email'], 'Confrim Signup', "<h3>{$_SESSION['tmp_user_vcode']}</h3>", '');
	}

	public function resendVCode() {
		$this->db->mail($_SESSION['tmp_user_email'], 'Confrim Signup', "<h3>{$_SESSION['tmp_user_vcode']}</h3>", '');
	}

	public function clearTmp() {
		unset($_SESSION['tmp_user_first_name']);
		unset($_SESSION['tmp_user_last_name']);
		unset($_SESSION['tmp_user_email']);
		unset($_SESSION['tmp_user_password']);
		unset($_SESSION['tmp_user_phone']);
		unset($_SESSION['tmp_user_country']);
		unset($_SESSION['tmp_user_vcode']);
		unset($_SESSION['tmp_vcode_attempt']);
	}

	public function setVCode() {
		$_SESSION['tmp_user_vcode'] = rand(100000,999999);
	}

	public function login($u, $p) {
		$this->db->query('SELECT * FROM `user` WHERE `u_email` = :e AND `u_password` = :p');
		$this->db->bind(':e', $u, $this->db->PARAM_STR);
		$this->db->bind(':p', md5($p), $this->db->PARAM_STR);
		return $this->db->single();
	}
}

?>