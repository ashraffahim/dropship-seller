<?php

namespace models;

use libraries\Database;

class _Product {
	
	private $db;

	public function __construct() {
		$this->db = new Database();
	}

	public function index() {
		$this->db->query('SELECT * FROM `draft_new_product`');
		return $this->db->result();
	}

	public function add($data) {
		
		// Format custom field data
		if (isset($data['cft'])) {
			$cfd = [];
			foreach ($data['cft'] as $i => $cft) {
				$cfd[$cft] = $data['cfv'][$i];
			}
			$cfd = addslashes(json_encode($cfd));
		} else {
			$cfd = '';
		}

		$this->db->query('INSERT INTO `draft_new_product` (
			`dp_name`,
			`dp_description`,
			`dp_category`,
			`dp_price`,
			`dp_brand`,
			`dp_model`,
			`dp_custom_field`,
			`dp_status`,
			`dp_sellerstamp`,
			`dp_timestamp`,
			`dp_latimestamp`
		) VALUES (
			"' . $data['name'] . '",
			"' . $data['description'] . '",
			"' . $data['category'] . '",
			"' . $data['price'] . '",
			"' . $data['brand'] . '",
			"' . $data['model'] . '",
			"' . $cfd . '",
			1,
			' . $_SESSION[CLIENT . 'user_id']->id . ',
			' . time() . ',
			' . time() . '
		)');

		$this->db->execute();

		$insid = $this->db->lastInsertId();

		mkdir(DATADIR . DS . 'draft-new-product' . DS . $insid);

		if ($_FILES['images']['tmp_name'][0] != '') {
			foreach($_FILES['images']['tmp_name'] as $j => $ftnm) {
				$this->db->convertImageToJPG($ftnm, DATADIR . DS . 'draft-new-product' . DS . $insid . DS . $j . '.jpg', 75);
			}
		}

		// Update number of images provided for the product
		$this->db->query('UPDATE `draft_new_product` SET `dp_image` = ' . $j . ' WHERE `id` = ' . $insid);
		$this->db->execute();

		return [
			'status' => true
		];
	}

}

?>