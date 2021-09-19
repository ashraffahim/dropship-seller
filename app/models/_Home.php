<?php

namespace models;

use libraries\Database;

class _Home {

	private $db;

	function __construct() {
		$this->db = new Database();
	}

	public function feed() {
	}
}

?>