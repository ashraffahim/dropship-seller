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

		$this->db->query('INSERT INTO `draft_product` (`dp_name`, `dp_handle`, `dp_category`, `dp_description`, `dp_brand`, `dp_category`, `dp_category_spec`, `dp_custom_field`, `dp_price`, `dp_status`, `dp_sellerstamp`, `dp_timestamp`, `dp_latimestamp`) VALUES (:n, :h, :c, :cs, :cf, :p, ' . (isset($d['status']) ? 1 : 0) . ', ' . $_SESSION['uid'] . ', ' . time() . ', ' . time() . ')');

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
		$this->db->bind(':h', $d['handle'], $this->db->PARAM_STR);
		$this->db->bind(':c', $d['category'], $this->db->PARAM_STR);
		$this->db->bind(':d', $d['description'], $this->db->PARAM_STR);
		$this->db->bind(':b', $d['brand'], $this->db->PARAM_STR);
		$this->db->bind(':m', $d['model'], $this->db->PARAM_STR);
		$this->db->bind(':cs', json_encode('{}'), $this->db->PARAM_STR);
		$this->db->bind(':cf', json_encode($cfs), $this->db->PARAM_STR);
		$this->db->bind(':p', $d['price'], $this->db->PARAM_STR);

		$this->db->execute();
		$id = $this->db->lastInsertId();

		mkdir(DATADIR.DS.'draft'.DS.$id);
		
		// Validate images
		if (!isset($f['photos']['name'])) return [
			'alrt' => [
				't' => 'danger',
				'b' => '<i data-feather="alert-octagon"></i><b class="ml-2">Images are required!</b> Upload atleast one image.'
			]
		];
		
		foreach ($f['photos']['tmp_name'] as $i => $n) {
			if ($f['photos']['error'][$i] != 0 && !preg_match('/image\/.*/', mime_content_type($f['photos']['tmp_name'][$i]))) return [
				'alrt' => [
					't' => 'danger',
					'b' => '<i data-feather="alert-octagon"></i><b class="ml-2">Image files are corrupted!</b> Use different images and try again.'
				]
			];
			move_uploaded_file($n, DATADIR.DS.'draft'.DS.$id.DS.$f['photos']['name'][$i]);
		}
	}

	public function list() {
		$this->db->query('SELECT * FROM `draft_product` WHERE `dp_sellerstamp` = ' . $_SESSION['uid']);
		$d = $this->db->result();
		$this->db->query('SELECT * FROM `product` WHERE `p_sellerstamp` = ' . $_SESSION['uid']);
		$p = $this->db->result();

		return [$d, $p];
	}

	public function availability($n) {
		$this->db->query('SELECT `id` FROM `product` WHERE UPPER(`p_handle`) = :n');
		$this->db->bind(':n', strtoupper($n), $this->db->PARAM_STR);

		return $this->db->single();
	}
}

?>