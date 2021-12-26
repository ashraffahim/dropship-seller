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

		// Validate inputs

		$validator = [];

		$this->db->query('INSERT INTO `draft_product` (`dp_name`, `dp_category`, `dp_category_spec`, `dp_custom_field`, `dp_price`, `dp_status`, `dp_userstamp`, `dp_timestamp`, `dp_latimestamp`) VALUES (:n, :c, :cs, :cf, :p, ' . (isset($d['status']) ? 1 : 0) . ', ' . $_SESSION['uid'] . ', ' . time() . ', ' . time() . ')');

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
		
		// Validate images
		if (!isset($f['photos']['name'])) return [
			'alrt' => [
				't' => 'danger',
				'b' => '<i data-feather="alert-octagon"></i><b class="ml-2">Images are required!</b> Upload atleast one image.'
			]
		];
		if ($file['error'] != 0 && !preg_match('/image\/.*/', mime_content_type($file['tmp_name']))) return [
			'alrt' => [
				't' => 'danger',
				'b' => '<i data-feather="alert-octagon"></i><b class="ml-2">Image files are corrupted!</b> Use different images and try again.'
			]
		];
		
		foreach ($f['photos']['tmp_name'] as $i => $n) {
			move_uploaded_file($n, DATADIR.DS.'product'.DS.$id.DS.$f['photos']['name'][$i]);
		}
	}

	public function list() {
		$this->db->query('SELECT * FROM `product` WHERE `p_userstamp` = ' . $_SESSION['uid']);
		return $this->db->result();
	}

	public function availability($n) {
		$this->db->query('SELECT `id` FROM `product` WHERE `p_name` = :n');
		$this->db->bind(':n', str_replace(' ', '-', strtoupper($n)), $this->db->PARAM_STR);

		return $this->db->single();
	}
}

?>