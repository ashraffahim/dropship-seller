<?php

namespace models;

use libraries\Database;

class _Product {

	private $db;

	function __construct() {
		$this->db = new Database();
	}

	public function details($p) {
		return [];
	}

	public function create($d, $f = []) {
		$this->db->query('INSERT INTO `product` (`p_name`, `p_category`, `p_category_spec`, `p_custom_field`, `p_price`, `p_status`, `p_userstamp`, `p_timestamp`, `p_latimestamp`) VALUES (:n, :c, :cs, :cf, :p, ' . (isset($d['status']) ? 1 : 0) . ', ' . $_SESSION['uid'] . ', ' . time() . ', ' . time() . ')');

		$cfs = [];
		if (isset($d['custom_field'])) {
			foreach($d['custom_field'] as $i => $cf) {
				$cv = $d['custom_value'][$i];
				if ($cf != '' && $cv != '') {
					$cfs[$cf] = $cv;
				}
			}
		}

		$this->db->bind(':n', $d['name'], $this->db->PARAM_STR);
		$this->db->bind(':c', $d['category'], $this->db->PARAM_STR);
		$this->db->bind(':cs', json_encode('{}'), $this->db->PARAM_STR);
		$this->db->bind(':cf', json_encode($cfs), $this->db->PARAM_STR);
		$this->db->bind(':p', $d['price'], $this->db->PARAM_STR);

		$this->db->execute();
		$id = $this->db->lastInsertId();

		mkdir(DATADIR.DS.'product'.DS.$id);
		
		if (isset($f['photos']['name'])) {
			foreach ($f['photos']['tmp_name'] as $i => $n) {
				move_uploaded_file($n, DATADIR.DS.'product'.DS.$id.DS.$f['photos']['name'][$i]);
			}
		}

	}

	public function list() {
		$this->db->query('SELECT * FROM `product` WHERE `p_userstamp` = ' . $_SESSION['uid']);
		return $this->db->result();
	}
}

?>