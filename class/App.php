<?php

class App {

	static $db = null;

	static function getDatabase() {
		if (!self::$db) {
			self::$db = new Database('root', 'root', 'camagru');
		}
		return self::$db;
	}

	static function getAuth() {
		return new auth(Session::getInstance(), ['restriction_msg' => 'Tu es bloqué !']);
	}

	static function redirect($page) {
		header('Location: '.$page);
		exit();
	}
}