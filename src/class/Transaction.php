<?php

class Transaction extends DbObject {
    public $id;
	public $type;
	public $emitter_id;
    public $emitter_amount;
    public $emitter_currency;
    public $receiver_id;
    public $receiver_amount;
    public $receiver_currency;
	public $status;
	public $processed;
    public $processed_at;
    public $processed_by;
	public $created_at;
}

?>