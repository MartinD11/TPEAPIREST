<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/helpers/auth.api.helper.php';
require_once 'app/models/categories.model.php';
require_once 'app/models/product.model.php';

class CategoryController extends ApiController {

    private $Model;
    private $ModelP;
    private $authHelper;

     public function __construct() {
        parent::__construct();
        $this->Model = new CategoryModel();
        $this->ModelP =  new ProductModel();
        $this->authHelper = new AuthHelper();
    }

    public function showCategories(){
        $categories = $this->Model->getCategories();

        if(!empty($categories)){
            $this->View->response($categories,200);
        }else {
            $this->View->response('categorias no encontradas',404);
        }
    }


    public function categoryById($params = []){
        $id = $params[':ID'];

        if(!empty($id)){
            $category = $this->Model->getCategorieId($id);
            if(!empty($category)){
                $this->View->response($category,200);
            }else {
                $this->View->response('el producto no existe',404);
            }
            return $category;
        }
    }

    public function updateCategory($params = []){
        $id = $params[':ID'];
        $category = $this->Model->getCategorieId($id);

        if(!empty($category)){
            $body = $this->getData();
            $categoria=$body->Categoria;
            $gama=$body->Gama;
            

            $user = $this->authHelper->currentUser();
            if(!$user) {
                $this->View->response('Unauthorized', 401);
                return;
            }
            
            $this->Model->updateCat($id, $categoria,$gama);

            $this->View->response('el prodcuto con id='. $id . 'ha sido modificado', 200);

        }else {
            $this->View->response('el prodcuto con id='. $id . 'no existe', 404);
        }
    }


    public function createCategory($params = []){
        $body=$this->getData();
            
            $categoria=$body->Categoria;
            $gama=$body->Gama;
            

        if(!empty($categoria) &&!empty($gama) ){
            $user = $this->authHelper->currentUser();
            if(!$user) {
                $this->View->response('Unauthorized', 401);
                return;
            }
            $id=$this->Model->createCat($categoria,$gama);
            $category=$this->Model->getCategorieId($id);
            $this->View->response($category,201);
        }else{
            $this->View->response('Faltan completar campos', 400);
        }
    }

    public function deleteCategory($params = []){
        $user = $this->authHelper->currentUser();
            if(!$user) {
                $this->View->response('Unauthorized', 401);
                return;
            }
        $id = $params[':ID'];
            $category = $this->Model->getCategorieId($id);
            $product = $this->ModelP->verifyExist($id);
            
            if ($category) {
                if (!($product)) {
                    $this->Model->removeCategory($id);
                    $this->View->response('El producto con id='.$id.' ha sido borrado.', 200);
                } else {
                    $this->View->response('No es posible eliminar, primero debería eliminar todos los productos que pertenecen a esta categoría', 404);
                }
            } else {
                $this->View->response('La categoría con id='.$id.' no existe.', 404);
            }
    }

}