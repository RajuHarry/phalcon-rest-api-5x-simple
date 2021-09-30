<?php
define('APP_PATH', realpath('..') . '/');
use Phalcon\Di;
use Phalcon\Mvc\Micro;
use Phalcon\Mvc\Router;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Http\Response;
use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;

try {
$container = new Di();    
$app = new Micro();

$app->get(
    "/",
    function () use ($app){
        echo "<h1>Welcome!</h1>";
        echo '<h2>5x Version Phalcon Working Now Micro API</h2>';
        echo php_uname()."<br>";
        echo PHP_OS."<br>";
    }
);
$app->get(
    "/hello",
    function () use ($app){
        echo "<h1>Welcome!</h1>";
        echo '<h1>3.1459</h1>';
    }
);

$app->get(
    "/say/hello/{name}",
    function ($name) use ($app) {
        echo "<h1>Hello! $name</h1>";

        echo "Your IP Address is ", $app->request->getClientAddress();
    }
);
$app->get(
    '/invoices/view/{id}',
    function ($id) {
        echo "<h1>Invoice #{$id}!</h1>";
    }
);

$app->notFound(
    function () use ($app) {
        $app->response->setStatusCode(404, "Not Found");

        $app->response->sendHeaders();

        echo "This is crazy, but this page was not found! 404";
    }
);

$path = str_replace($_SERVER["DOCUMENT_ROOT"], '', str_replace('\"', "/", APP_PATH));
    
//$uri = str_replace($path, '/', $_SERVER['REQUEST_URI']);
//echo $path."<br>";
//echo $uri."<br>";//exit;
//echo $_SERVER['REQUEST_URI']."<br>";//exit;
//echo $_SERVER["DOCUMENT_ROOT"]."<br>";//exit;
//echo APP_PATH."<br>";//exit;

//$uri = str_replace($uri, '',$_SERVER['REQUEST_URI']);
//echo $uri."<br>";exit;
$app->handle($path);

} catch (Exception $e){
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}