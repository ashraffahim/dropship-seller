<?php

namespace models;

use libraries\Database;

class _Country {

	private $db;

	function __construct() {
		$this->db = new Database();
	}

	public function codeName() {
		$this->db->query('
			SELECT 
				`code`, 
				`name` 
			FROM 
				`sys_country`
		');
		return $this->db->result();
	}

	public function currencySymbol() {
		$this->db->query('
			SELECT 
				`currency`, 
				`currency_symbol` 
			FROM 
				`sys_country`
		');
		return $this->db->result();
	}

}

?>