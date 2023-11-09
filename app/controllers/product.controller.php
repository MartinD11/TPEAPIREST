<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/helpers/auth.api.helper.php';
require_once 'app/models/product.model.php';

class ProductApiController extends ApiController{
    private $Model;
    private $authHelper;

     public function __construct() {
        parent::__construct();
        $this->Model = new ProductModel();
        $this->authHelper = new AuthHelper();
    }


    public function showAll($params = NULL) {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $per_page = isset($_GET['per_page']) ? $_GET['per_page'] : null;
    
        // Convierte $page en un entero
        $page = (int)$page;
        
        if((isset($_GET['sortby'])&&(isset($_GET['order'])))) {
            $sortby=$_GET['sortby'];
            $order=$_GET['order'];
            //agregra los campos restantes de categorias y productos
            $arr_Atributs=['Producto','Precio', 'Descripcion', 'Stock', 'Imagen', 'id_categorias','id_producto'];

            if(in_array($sortby, $arr_Atributs)){
                if($order=='asc'|| $order=='desc'){
                $products=$this->Model->orderASCCol($sortby, $order);
                $this->View->response($products,200);
                }else{
                    if (!($order == 'asc' || $order == 'desc')) {
                        $this->View->response("Página no válida", 400);
                    }
                }
            }else{
                $this->View->response("Página no válida", 400);
            }
        }else if ($page > 0) {
        if ($per_page === null) {
            //si perpegae es nulo entonces va a mostrar todos los productos
            $products = $this->Model->getProducts();
            $this->View->response($products, 200);
        } else {
            //si no es nulo, se realiza la paginacion
            $offSet = ($page - 1) * $per_page;
            $per_page = (int)$per_page;
            $offSet = (int)$offSet;
            $products = $this->Model->paginacion($per_page, $offSet);
            $this->View->response($products, 200);
        }
    } else {
        // Maneja el caso en el que $page no es un valor válido
        $this->View->response("Página no válida", 400); 
    }
        
    }
    
    
//filtro que funciona por los precios menos a x cantidad dada por el usuario
    public function filter($params=[]){
        if(isset($_GET['precio'])){
            $filtro = intval($_GET['precio']);
            $products = $this->Model->filterByPrice($filtro);
            if(!empty($products)){
                $this->View->response($products,200);
            }else{
                $this->View->response('no se ha encontrada ningun resultado con el parametro : '.$filtro. ' ' ,404);
            }

        }else{
            $this->View->response('el parametro proporcionado es invalido o no se ha proporcionado uno ', 404 );
        }
    }
    

    public function showById($params = []){
        $id = $params[':ID'];

        if(!empty($id)){
            $product = $this->Model->getProductId($id);
            if(!empty($product)){
                $this->View->response($product,200);
            }else {
                $this->View->response('el producto no existe',404);
            }
            return $product;
        }
    }


    public function update($params = []){

        $id = $params[':ID'];
        $product = $this->Model->getProductId($id);

        if(!empty($product)){
            $body = $this->getData();
            $producto=$body->Producto;
            $precio=$body->Precio;
            $descripcion=$body->Descripcion;
            $stock=$body->Stock;
            $imagen=$body->Imagen;

            $user = $this->authHelper->currentUser();
            if(!$user) {
                $this->View->response('Unauthorized', 401);
                return;
            }
            
            $this->Model->update($id, $producto,$precio,$descripcion,$stock,$imagen);

            $this->View->response('el prodcuto con id='. $id . 'ha sido modificado', 200);

        }else {
            $this->View->response('el prodcuto con id='. $id . 'no existe', 404);
        }
    }

    public function delete($params = []){
        $user = $this->authHelper->currentUser();
            if(!$user) {
                $this->View->response('Unauthorized', 401);
                return;
            }
        $id = $params[':ID'];
            $products = $this->Model->getProductId($id);

            if($products) {
                $this->Model->remove($id);
                $this->View->response('El producto con id='.$id.' ha sido borrado.', 200);
            } else {
                $this->View->response('El prodcuto con id='.$id.' no existe.', 404);
            }

    }

    public function create(){
        $body=$this->getData();
            
            $producto=$body->Producto;
            $precio=$body->Precio;
            $descripcion=$body->Descripcion;
            $stock=$body->Stock;
            $imagen=$body->Imagen;
            $categoria=$body->id_categorias;

        if(!empty($producto)&&!empty($precio)&&!empty($descripcion)&&!empty($stock)&& !empty($imagen) &&!empty($categoria) ){
            $user = $this->authHelper->currentUser();
            if(!$user) {
                $this->View->response('Unauthorized', 401);
                return;
            }
            $id=$this->Model->create($producto,$precio,$descripcion,$stock,$imagen,$categoria);
            $product=$this->Model->getProductId($id);
            $this->View->response($product,201);
        }else{
            $this->View->response('Faltan completar campos', 400);
        }
        

    }


}