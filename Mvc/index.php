<?php

namespace Mvc;

/**
 * Author Cyril Pereira
 * Bootstrap microframework.
 */

use Autoload\Autoloader;
//use Mvc\Controller\ControllerAbstract;
//use Mvc\Controller\IndexController;

require '../Autoload/Autoloader.php';

Autoloader::register();

include 'Request.php';
include 'Controller/ControllerAbstract.php';
include 'Controller/IndexController.php';

include 'Container.php';
include 'ContainerInterface.php';

$request = Request::getInstance();

$container = new Container();
$db = new \Classe\DataBase(); 
$container->add('database', $db);

$controller = $request->get('controller', 'index');
$className = UCFirst($controller).'Controller';

$rendered = false;

if (file_exists(sprintf('Controller/%s.php', $className))) {
    if (class_exists($className)) {
        $controller = new $className(null, $container->get('database'));
        $action = $request->get('action', 'index');
        if ($action && method_exists($controller, $action)) {
            $controller->$action();
            $rendered = true;
        }
    }
}

if (!$rendered) {
    $controller = new IndexController();
    $controller->notfound();
}
