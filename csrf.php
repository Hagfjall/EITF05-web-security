<?php
	function init_csrf_token($form_name='') {
		$token= hash("sha512", mt_rand(0,mt_getrandmax()));
		$_SESSION[$form_name] = $token;
		return $token;
	}

	function validate_csrf($form_name='', $token='') {
		if (!isset($_SESSION[$form_name])) {
			return false;
		}

		$session_token = $_SESSION[$form_name];
		return $session_token == $token;
	}
?>