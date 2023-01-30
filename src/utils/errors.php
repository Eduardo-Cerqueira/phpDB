<?php

function set_errors($msg, $page) {
	$_SESSION['error_msg'] = $msg;
	header('Location: ' .$page);
	die();
}

function get_errors() {
	$msg = false;
	if (isset($_SESSION['error_msg'])) {
		$msg = $_SESSION['error_msg'];
		unset($_SESSION['error_msg']);
	}
	return $msg;
}
