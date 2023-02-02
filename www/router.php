<?php




    $url = parse_url($_SERVER['REQUEST_URL'])['path'];

    $routes = [
        '/' => 'pages/home.php',
        '/' => 'pages/contact.php',
        '/' => 'pages/login.php',
        '/' => 'www/index.php',
        '/' => 'www/login.php',

    ];
    function routeToPages($url, $routes) {
        if(array_key_exists($url, $routes)) {
            require $routes[$url];
        } else {
            abort();
        }
    }
    function abort($code = 404) {
        http_response_code($code);

        require "partials/{$code}.php";

        die();
    }




?>