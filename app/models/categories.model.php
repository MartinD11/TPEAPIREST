<?php 

class CategoryModel extends Model {

    public function getCategories(){
        $query = $this->db->prepare('SELECT * FROM categorias ');
        $query->execute();
        $categories = $query->fetchAll(PDO::FETCH_OBJ);
        return $categories;
    }

    public function getCategorieId($id){
        $query = $this->db->prepare('SELECT * FROM categorias WHERE id_categorias = ?');
        $query->execute([$id]);

        
        $category = $query->fetch(PDO::FETCH_OBJ);

        return $category;
    }

    public function updateCat($id, $categoria,$gama){
        $query= $this->db->prepare('UPDATE categorias SET Categoria = ?,Gama = ? WHERE id_categorias = ? ');
        $query->execute([$categoria,$gama,$id]);
    }

    public function createCat($categoria,$gama){
        $query= $this->db->prepare('INSERT INTO categorias(Categoria,Gama)VALUES (?,?)');
        $query->execute([$categoria,$gama]);

        return $this->db->lastInsertId();
    }

    public function removeCategory($id){
        $query = $this->db->prepare('DELETE FROM categorias WHERE id_categorias= ?');
        $query->execute([$id]);
    }
}