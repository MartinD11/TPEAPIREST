<?php
require 'app/models/model.php';
class ProductModel extends  Model {


    public function getProducts(){
        $query= $this->db->prepare('SELECT * FROM productos');
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    public function remove($id){
        $query = $this->db->prepare('DELETE FROM productos WHERE id_producto = ?');
        $query->execute([$id]);

    }

    public function getProductId($id){
        $query = $this->db->prepare('SELECT * FROM productos WHERE id_producto = ?');
        $query->execute([$id]);

        
        $product = $query->fetch(PDO::FETCH_OBJ);

        return $product;

    }

    public function update($id, $producto,$precio,$descripcion,$stock,$imagen){
        $query= $this->db->prepare('UPDATE productos SET Producto = ?,Precio = ?,Descripcion =?, Stock=?, Imagen=? WHERE id_producto = ? ');
        $query->execute([$producto,$precio,$descripcion,$stock,$imagen,$id]);
    }

}