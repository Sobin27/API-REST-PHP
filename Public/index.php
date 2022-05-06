<?php

require_once '../vendor/autoload.php';

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$url = explode('/', $url);


if ($url[1] === 'api') {
    //apaga o primeiro indice do array
    array_shift($url);

    $services = 'App\\Services\\' . ucfirst($url[1] . 'Services');
    array_shift($url);
    array_shift($url);

    $method = strtolower($_SERVER['REQUEST_METHOD']);

    try {
        $reponse = call_user_func_array(array(new $services, $method), $url);
        
        http_response_code(200);
        echo json_encode(array('status' => 'sucess', 'data' => $reponse),JSON_UNESCAPED_UNICODE);
        exit;
    } catch (Exception $e) {
        http_response_code(404);
        echo json_encode(array('status' => 'error', 'data' => $e->getMessage()), JSON_UNESCAPED_UNICODE);
        exit;
    }

    var_dump($method);
}
