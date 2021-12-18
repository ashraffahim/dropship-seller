<?php

namespace models;

use libraries\Database;

class _Menu {

	private $db;

	function __construct() {
		$this->db = new Database();
	}

	public function brochureList($r, $b = false) {

		// Menu header info - name, title, desc
		// $this->db->query('SELECT `p`.* FROM `product` `p` WHERE `p`.`id` IN (SELECT `m_pid` FROM `menu` WHERE `m_qid` IN (SELECT `id` FROM `qr` WHERE `q_restaurantstamp` IN (SELECT `id` FROM `restaurant` WHERE REPLACE(`r_name`, " ", "-") = :r)))');
		if ($b) {
			$this->db->query('SELECT `q`.`id`, `r_name` `restaurant`, `q_title` `title`, `q_description` `description` FROM `qr` `q` JOIN `restaurant` `r` ON `q_restaurantstamp` = `r`.`id` WHERE  REPLACE(`r_name`, " ", "-") = :r AND REPLACE(`q_title`, " ", "-") = :b');
			$this->db->bind(':b', $b, $this->db->PARAM_STR);
		} else {
			$this->db->query('SELECT `id`, `r_name` `restaurant`, "" `title`, "" `description` FROM `restaurant` WHERE  REPLACE(`r_name`, " ", "-") = :r');
		}
		$this->db->bind(':r', $r, $this->db->PARAM_STR);
		
		$h = $this->db->single();

		// Menu items
		$this->db->query('SELECT * FROM `product` WHERE ' . ($b ? '`id` IN (SELECT `m_pid` FROM `menu` WHERE `m_qid` = ' . $h->id . ')' : '`p_restaurantstamp` = ' . $h->id));

		return [$h, $this->db->result()];
	}

	public function create($p) {
		$this->db->query('INSERT INTO `qr` (`q_title`, `q_description`, `q_status`, `q_restaurantstamp`, `q_timestamp`, `q_latimestamp`) VALUES (:r, :t, :d, ' . (isset($p['status']) ? 1 : 0) . ', "' . $_SESSION['uid'] . '", "' . time() . '", "' . time() . '")');
		$this->db->bind(':t', $p['title'], $this->db->PARAM_STR);
		$this->db->bind(':d', $p['description'], $this->db->PARAM_STR);

		$this->db->execute();

		return ['id' => $this->db->lastInsertId()];
	}

	public function list($id) {
		$this->db->query('SELECT * FROM `qr` WHERE `q_restaurantstamp` = :id');
		$this->db->bind(':id', $id, $this->db->PARAM_INT);
		return $this->db->result();
	}

	public function detail($id) {
		$this->db->query('SELECT * FROM `qr` WHERE `id` = :id');
		$this->db->bind(':id', $id, $this->db->PARAM_INT);
		return $this->db->single();
	}

	public function menu($id) { 
		$this->db->query('SELECT `p`.*, IF(ISNULL(`m_pid`), "", " checked") `chkd`, IF(ISNULL(`m_pid`), "", "text-success") `chkd_color`, `m_qid`, `m_pid`, `m_attribute`, `m_timestamp` FROM `menu` `m` RIGHT JOIN `product` `p` ON (`p`.`id` = `m`.`m_pid`) WHERE `p_restaurantstamp` = :id ORDER BY `chkd`');
		$this->db->bind(':id', $id, $this->db->PARAM_INT);
		return $this->db->result();
	}

	public function assign($m, $i) {

		// Check menu's original creator (restaurant) / owership
		$mc = $this->db->query('SELECT `id` FROM `qr` WHERE `id` = :id AND `q_restaurantstamp` = ' . $_SESSION['uid']);
		$this->db->bind(':id', $m, $this->db->PARAM_INT);

		if (!$this->db->single()) {
			return [
				'alrt' => [
					't' => 'danger',
					'b' => '<i data-feather="alert-octagon"></i> <b class="ml-3">Update failed due to unusual activity. Please try again!</b>'
				]
			];
		}

		if (isset($i['pid']) && !empty($i['pid'])) {

			// Delete all previous record of this qr
			$this->db->query('DELETE FROM `menu` WHERE `m_qid` = ' . $m);
			$this->db->execute();

			// `m_qid` bindValue called above for validation. Do not call again.
			$qs = '(' . $m . ', ?, ?, ' . time() . ', ' . time() . ')';
			$qv = [$i['pid'][0], ''];
			for ($j = 1;$j <= count($i['pid']) - 1;$j++) {
				$qs .= ',(' . $m . ', ?, ?, "", "")';
				$qv[] = $i['pid'][$j];
				$qv[] = '';
			}

			$this->db->query('INSERT INTO `menu` (`m_qid`, `m_pid`, `m_attribute`, `m_timestamp`, `m_latimestamp`) VALUES ' . $qs);
			if ($this->db->execute($qv)) {
				return [
					'alrt' => [
						't' => 'success',
						'b' => '<i data-feather="check"></i> <b class="ml-3">Menu updated!</b>'
					]
				];
			} else {
				return [
					'alrt' => [
						't' => 'warning',
						'b' => '<i data-feather="alert-triangle"></i> <b class="ml-3">Something went wrong. Try again!</b>'
					]
				];
			}

		}
	}
}

?>