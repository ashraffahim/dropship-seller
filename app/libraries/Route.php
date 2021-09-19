<?php

namespace libraries;

class Route {

	private static $param;

	public static function parseQS($qs) : void {
		// Query string parsing rule
		// /<controller>/<action>/[,args...]
		$qs = self::removeQSVar($qs);
		preg_match('/^([a-z]+|)(?:\/|)([a-z]+|)(?:\/|)(.*)$/i', $qs, $rgx);
		self::$param['controller'] = $rgx[1] != '' ? $rgx[1] : 'home';
		self::$param['action'] = $rgx[2] != '' ? $rgx[2] : 'index';
		self::$param['args'] = $rgx[3] != '' ? explode('/', $rgx[3]) : [];
	}

	public static function dispatch() {
		// Format controller and action
		$controller = 'controllers\\' . self::convertToStudlyCaps(self::$param['controller']);
		$action = self::convertToStudlyCaps(self::$param['action']);
		if (class_exists($controller)) {
			$controller_obj = new $controller();

			if (is_callable([$controller_obj, $action])) {
				call_user_func_array([$controller_obj, $action], array_values(self::$param['args']));
			}
		} else {
			$controller_obj = new \controllers\Product;
			$action = 'details';
			array_unshift(self::$param['args'], self::$param['controller'], self::$param['action']);
			call_user_func_array([$controller_obj, $action], array_values(self::$param['args']));
		}
	}

	private static function convertToStudlyCaps($str) {
		return str_replace(' ', '', ucwords(str_replace('-', ' ', $str)));
	}

	private static function convertToCamelCaps($str) {
		return lcfirst($this->convertToStudlyCaps($str));
	}

	private static function removeQSVar($qs) {
		$parts = explode('&', $qs);
		if (isset($parts[0])) {
			if (strpos($parts[0], '=') === false) {
				return $parts[0];
			} else {
				return '';
			}
		}
	}
}

?>