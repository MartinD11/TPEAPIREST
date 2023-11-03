<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/models/product.model.php';

class ProductApiController extends ApiController{
    private $Model;

     public function __construct() {
        parent::__construct();
        $this->Model = new ProductModel();
    }


    public function showAll($params = NULL) {
       
    
        if (isset($_GET['sortby']) && isset($_GET['order'])) {
            $sortby = $_GET['sortby'];
            $order = $_GET['order'];
    
            if ($sortby == 'Precio') {
                if ($order == 'asc') {
                    $products = $this->Model->orderASC();
                } elseif ($order == 'desc') {
                    $products = $this->Model->orderDESC();
                }
            }else {
                return $this->View->response('error', 404);
            }
        } else {
            $products = $this->Model->getProducts();
        }
    
        return $this->View->response($products, 200);
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

            $this->Model->update($id, $producto,$precio,$descripcion,$stock,$imagen);

            $this->View->response('el prodcuto con id='. $id . 'ha sido modificada', 200);

        }else {
            $this->View->response('el prodcuto con id='. $id . 'no existe', 404);
        }
    }

    public function delete($params = []){
        $id = $params[':ID'];
            $products = $this->Model->getProductId($id);

            if($products) {
                $this->Model->remove($id);
                $this->View->response('La tarea con id='.$id.' ha sido borrada.', 200);
            } else {
                $this->View->response('La tarea con id='.$id.' no existe.', 404);
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
            $id=$this->Model->create($producto,$precio,$descripcion,$stock,$imagen,$categoria);
            $product=$this->Model->getProductId($id);
            $this->View->response($product,201);
        }else{
            $this->View->response('Faltan completar campos', 400);
        }
        

    }


}