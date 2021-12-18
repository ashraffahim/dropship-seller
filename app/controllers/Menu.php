<?php

namespace controllers;

use libraries\Controller;
use models\_Menu;

class Menu extends Controller {

	private $m;

	function __construct() {
		$this->m = new _Menu();
	}

	public function brochure($r, $b = false) {
		$b = $this->m->brochureList($r, $b);
		$this->view('menu' . DS . 'view', ['data' => $b], false, false);
	}

	public function add() {
		$this->requireLogin();
		if ($this->RMisPost()) {
			$this->sanitizeInputPost();
			$this->m->create($_POST);
		}
		$this->view('menu' . DS . 'add');
	}

	public function index() {
		$this->requireLogin();
		$qs = $this->m->list($_SESSION['uid']);
		$this->view('menu/index', ['qs' => $qs]);
	}

	public function assign($id = false) {
		$this->requireLogin();
		$st = [];
		if (!$id) { header('Location: /menu/index'); }
		if ($this->RMisPost()) {
			$this->sanitizeInputPost();
			$st = $this->m->assign($id, $_POST);
		}
		$ms = $this->m->menu($id);
		$qs = $this->m->detail($id);
		$this->view('menu' . DS . 'assign', [
			'status' => $st,
			'qs' => $qs,
			'ms' => $ms
		]);
	}
}

?>