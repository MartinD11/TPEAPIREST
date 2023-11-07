<?php
    require_once 'app/models/model.php';

class UserModel extends Model {
    public function getByUser($user) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE User = ?');
        $query->execute([$user]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
}
