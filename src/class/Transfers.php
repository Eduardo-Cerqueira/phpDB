<?php

class Transfers extends DbObject {
    public $id;
	public $type;
	public $sender;
    public $receiver;
    public $amount;
    public $currency;
    public $gain;
	public $status;
    public $created_at;
}
?>