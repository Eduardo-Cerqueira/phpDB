<?php

class DbObject {
    public function getCreatedAt() {
		if (isset($this->created_at)) {
			$date = new DateTime($this->created_at);
			return $date->format('d/m/Y H:i:s');
		}
		return 'Pas de champs "created_at"';
	}
}
