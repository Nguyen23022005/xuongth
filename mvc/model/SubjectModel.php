<?php
require_once "Database.php";

class SubjectsModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllSubjects()
    {
        $query = "
        SELECT subjects.*, categories.name AS category_name 
        FROM subjects
        LEFT JOIN categories ON subjects.category_id = categories.id
    ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPaginatedSubjects($limit, $offset) {
        $sql = "SELECT * FROM subjects LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalSubjects() {
        $sql = "SELECT COUNT(*) AS total FROM subjects";
        $stmt = $this->conn->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    public function getAll()
    {
        $query = "SELECT * FROM subjects";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSubjectsGroupedByCategory()
    {
        $query = "
        SELECT subjects.*, categories.name AS category_name, categories.id AS category_id
        FROM subjects
        LEFT JOIN categories ON subjects.category_id = categories.id
        ORDER BY categories.id
    ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Nhóm sản phẩm theo danh mục
        $groupedsubjects = [];
        foreach ($subjects as $subject) {
            $groupedsubjects[$subject['category_name']][] = $subject;
        }

        return $groupedsubjects;
    }

    public function getSubjectById($id)

    {
        $query = "SELECT * FROM subjects WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createSubject($category_id, $user_id, $name, $image, $price, $sku, $status, $description)
    {
        $query = "INSERT INTO subjects (category_id, user_id , name, image, price, sku, status, description) VALUES (:category_id, :user_id, :name, :image, :price, :sku, :status, :description)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':description', $description);
        return $stmt->execute();
    }

    public function updateSubject($id, $category_id, $name, $image, $price, $sku, $status, $description)
    {
        $query = "UPDATE subjects SET category_id = :category_id, name = :name, image = :image, price = :price, sku = :sku, status = :status, description = :description WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':description', $description);
        return $stmt->execute();
    }

    public function updateUserSubject($id, $user_quantity)
    {
        $query = "UPDATE subjects SET user_quantity = :user_quantity WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_quantity', $user_quantity);
        return $stmt->execute();
    }

    public function deleteSubject($id)
    {
        $query = "DELETE FROM subjects WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    public function getSubjectsByUser($user_id)
    {
        $query = "SELECT s.* 
                  FROM subjects s 
                  JOIN user_subjects us ON s.id = us.subject_id 
                  WHERE us.user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
