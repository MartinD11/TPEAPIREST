<?php
    require_once 'libs/router.php';

    require_once 'app/controllers/product.controller.php';

    require_once 'app/controllers/user.api.controller.php';

    require_once 'app/controllers/categories.controller.php';

    $router = new Router();

    #                 endpoint      verbo     controller           método
    $router->addRoute('productos',     'GET',    'ProductApiController', 'showAll'   );
    $router->addRoute('productos/:ID',     'GET',    'ProductApiController', 'showById'   );
    $router->addRoute('productos/:ID',     'DELETE',    'ProductApiController', 'delete'   );
    $router->addRoute('productos/:ID',     'PUT',    'ProductApiController', 'update'   );
    $router->addRoute('productos/',     'POST',    'ProductApiController', 'create'   );
    $router->addRoute('productos/filtro/precios',     'GET',    'ProductApiController', 'filter'   );
    //categories

    $router->addRoute('categorias',     'GET',    'CategoryController', 'showCategories'   );
    $router->addRoute('categorias/:ID',     'GET',    'CategoryController', 'categoryById'   );
    $router->addRoute('categorias/:ID',     'PUT',    'CategoryController', 'updateCategory'   );
    $router->addRoute('categorias/',     'POST',    'CategoryController', 'createCategory'   );
    $router->addRoute('categorias/:ID',     'DELETE',    'CategoryController', 'deleteCategory'   );
    $router->addRoute('user/token', 'GET',    'UserApiController', 'getToken'   );
    
    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
