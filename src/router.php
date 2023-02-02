<?php
class Router {

    private $url; 
    private $routes = ['www/index.php'];

    public function __construct($url){
        $this->url = $url;
    }

}

?>