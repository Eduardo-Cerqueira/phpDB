<?php

class Account extends DbObject {
    public $id;
	public $fullname;
	public $password;
	public $email;
	public $function;
	public $created_at;
    public $last_connection;

}

?>