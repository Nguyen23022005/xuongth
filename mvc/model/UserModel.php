<?php
require_once "Database.php";

class UserModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function register($name, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        return $stmt->execute();
    }

    public function login($email, $password) {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }

    public function getAllUser() {
        $query = "SELECT * FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getUserById1($id) {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($name, $email, $password ,$role) {
        $query = "INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);
        return $stmt->execute();
    }

    public function updateUser($id, $name, $email, $image, $phone ) {
        $query = "UPDATE users SET name = :name, email = :email, image = :image, phone = :phone WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':phone', $phone);
        return $stmt->execute();
    }

    public function updateUserFull(
        $id,
        $name,
        $email,
        $image,
        $phone,
        $diachi,
        $kinhnghiem,
        $bangcap,
        $truonghoc,
        $namhoc
    ) {
        $query = "UPDATE users SET 
                    name = :name,
                    email = :email,
                    image = :image,
                    phone = :phone,
                    diachi = :diachi,
                    kinhnghiem = :kinhnghiem,
                    bangcap = :bangcap,
                    truonghoc = :truonghoc,
                    namhoc = :namhoc
                  WHERE id = :id";
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':diachi', $diachi);
        $stmt->bindParam(':kinhnghiem', $kinhnghiem);
        $stmt->bindParam(':bangcap', $bangcap);
        $stmt->bindParam(':truonghoc', $truonghoc);
        $stmt->bindParam(':namhoc', $namhoc);
    
        return $stmt->execute();
    }
    

    public function deleteUser($id) {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
   
}
?>