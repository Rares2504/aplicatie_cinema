<?php
class User{
    public static function getAllUsers(){
        global $pdo;
        $sql = "SELECT * FROM utilizatori";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getUserById($user_id){
        global $pdo;
        $sql = "SELECT * FROM utilizatori
                WHERE uti_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(":user_id" => $user_id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getUserByEmail($email){
        global $pdo;
        $sql = "SELECT * FROM utilizatori WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(":email" => $email));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function createUser($nume, $prenume, $email, $parola){
        global $pdo;
        $sql = "INSERT INTO utilizatori(nume, prenume, email, parola, rol_id) 
                VALUES (:nume, :prenume, :email, :parola, :rol_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ":nume" => $nume,
            ":prenume" => $prenume,
            ":email" => $email,
            ":parola" => $parola,
            ":rol_id" => 2
        ));
    }

    public static function hasPermission($user_id, $permission_name){
        global $pdo;
        $sql = "SELECT count(*) as count
                FROM utilizatori u
                JOIN roluri_permisiuni rp ON u.rol_id = rp.rol_id
                JOIN permisiuni p ON rp.per_id = p.per_id
                WHERE u.uti_id = :user_id and p.nume = :permission_name";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ":user_id" => $user_id, 
            ":permission_name" => $permission_name
        ));
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res["count"] > 0;
    }
}

class UserRole {
    public static function getAllRoles() {
        global $pdo;
        $sql = "SELECT * 
                FROM roluri_utilizatori";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getRole($role_id) {
        global $pdo;

        $sql = "SELECT *
                FROM roluri_utilizatori 
                WHERE rol_id = :role_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(":role_id" => $role_id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>