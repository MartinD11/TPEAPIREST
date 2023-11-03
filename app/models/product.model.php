<?php
require 'app/models/model.php';
class ProductModel extends  Model {


    public function getProducts(){
        $query = $this->db->prepare('SELECT p.*, c.* FROM productos p INNER JOIN categorias c ON p.id_categorias = c.id_categorias');
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

    public function create($producto,$precio,$descripcion,$stock,$imagen, $categoria){
        $query= $this->db->prepare('INSERT INTO productos(Producto,Precio, Descripcion, Stock, Imagen, id_categorias)VALUES (?,?,?,?,?,?)');
        $query->execute([$producto,$precio,$descripcion,$stock,$imagen,$categoria]);

        return $this->db->lastInsertId();

    }

    public function orderASC(){
        $query = $this->db->prepare('SELECT p.*, c.* FROM productos p INNER JOIN categorias c ON p.id_categorias = c.id_categorias ORDER BY p.Precio ASC');
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }
    

    public function orderDESC(){
        $query = $this->db->prepare('SELECT p.*, c.* FROM productos p INNER JOIN categorias c ON p.id_categorias = c.id_categorias ORDER BY p.Precio DESC');
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }
}