<?php
    require_once 'libs/router.php';

    require_once 'app/controllers/product.controller.php';

    $router = new Router();

    #                 endpoint      verbo     controller           método
    $router->addRoute('productos',     'GET',    'ProductApiController', 'showAll'   );
    $router->addRoute('productos/:ID',     'GET',    'ProductApiController', 'showById'   );
    $router->addRoute('productos/:ID',     'DELETE',    'ProductApiController', 'delete'   );
    $router->addRoute('productos/:ID',     'PUT',    'ProductApiController', 'update'   );
    

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
