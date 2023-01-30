<?php

function get_session_user() {
	if (isset($_SESSION['user_id'])) {
		return $_SESSION['user_id'];
	}
	return false;
}

function get_user_by_id($id) {
	global $db;
	$query = $db->prepare('SELECT * FROM users WHERE id = ?');
	$query->execute([$id]);
	$query->setFetchMode(PDO::FETCH_ASSOC);
	$user = $query->fetch();
	return $user;
}