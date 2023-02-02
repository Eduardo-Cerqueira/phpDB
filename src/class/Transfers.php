<?php

class Transfers extends DbObject {
    public $id;
	public $sender;
    public $receiver;
    public $amount;
    public $currency;
    public $created_at;
}
?>