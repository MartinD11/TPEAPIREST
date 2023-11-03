<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/models/product.model.php';

class ProductApiController extends ApiController{
    private $Model;

     public function __construct() {
        parent::__construct();
        $this->Model = new ProductModel();
    }

    public function showAll(){
        $products = $this->Model->getProducts();
        if(empty($products)){
            $this->View->response('ha ocurrido un error',404);
        }else {
            $this->View->response($products,200);
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


}