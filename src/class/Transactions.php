<?php

class Transactions extends DbObject {
    public $id;
	public $type;
	public $user_id;
    public $amount;
    public $currency;
    public $status;
    public $processed;
    public $processed_at;
	public $processed_by;
	public $created_at;
}

?>
