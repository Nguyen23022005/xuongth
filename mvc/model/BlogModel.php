<?php
require_once "Database.php";

class BlogModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getBlog() {
        $query = "SELECT * FROM blog WHERE is_visible = 1"; // Chỉ lấy bài hiển thị
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lấy tất cả bài viết (bao gồm cả ẩn) cho admin
    public function getAllBlogs() {
        $query = "SELECT * FROM blog";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getBlogById($id) {
        $query = "SELECT * FROM blog WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Đảm bảo trả về mảng liên kết
    }

    public function createBlog($title, $content, $author, $image) {
        $query = "INSERT INTO blog (title, content, author, image, is_visible) 
                 VALUES (:title, :content, :author, :image, 1)"; // Mặc định hiển thị
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':image', $image);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function updateBlog($id, $title, $content, $author, $image) {
        $query = "UPDATE blog SET title = :title, content = :content, 
                 author = :author, image = :image WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':image', $image);
        return $stmt->execute();
    }

    public function deleteBlog($id) {
        $query = "DELETE FROM blog WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Phương thức toggle ẩn/hiện
    public function toggleVisibility($id) {
        $query = "UPDATE blog SET is_visible = NOT is_visible WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    //tìm kiếm bài viết
    public function searchBlog($keyword, $limit, $offset) {
        $query = "SELECT * FROM blog WHERE title LIKE :keyword OR content LIKE :keyword ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        
        $keyword = "%$keyword%";
        $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function countSearchResults($keyword) {
        $query = "SELECT COUNT(*) as total FROM blog WHERE title LIKE :keyword OR content LIKE :keyword";
        $stmt = $this->conn->prepare($query);
        $keyword = "%$keyword%";
        $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    
    public function countAllBlogs() {
        $query = "SELECT COUNT(*) as total FROM blog";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    public function paginationBlog($limit, $offset) {
        $query = "SELECT * FROM blog ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}