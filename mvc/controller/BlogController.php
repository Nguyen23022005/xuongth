<?php
require_once "model/BlogModel.php";
require_once "view/helpers.php";

class BlogController
{
    private $blogModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->blogModel = new BlogModel();
    }

    public function index()
    {
        try {
            $blog = $this->blogModel->getBlog(); // Chỉ lấy bài hiển thị
            renderAdminView("view/blog/index.php", compact('blog'), "list blog");
        } catch (Exception $e) {
            $errors = ["Error fetching blog posts: " . $e->getMessage()];
            renderAdminView("view/blog/index.php", compact('errors'), "list blog");
        }
    }

    // Danh sách tất cả bài viết (bao gồm ẩn) cho admin
    public function index1()
    {
        try {
            $keyword = $_GET['keyword'] ?? null;
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = 3; // Số bài viết trên mỗi trang
            $offset = ($page - 1) * $limit;
    
            if ($keyword) {
                $blogs = $this->blogModel->searchBlog($keyword, $limit, $offset);
                $totalBlogs = $this->blogModel->countSearchResults($keyword);
            } else {
                $blogs = $this->blogModel->paginationBlog($limit, $offset);
                $totalBlogs = $this->blogModel->countAllBlogs();
            }
    
            $totalPages = ceil($totalBlogs / $limit);
    
            renderView("view/blog/blog_list.php", [
                'blog' => $blogs,
                'totalPages' => $totalPages,
                'currentPage' => $page,
                'keyword' => $keyword
            ], "list blog");
    
        } catch (Exception $e) {
            $errors = ["Error fetching blog posts: " . $e->getMessage()];
            renderView("view/blog/blog_list.php", compact('errors'), "list blog");
        }
    }
    public function list($id)
    {
        try {
            // Kiểm tra ID hợp lệ
            if (!is_numeric($id)) {
                throw new Exception("Invalid blog ID");
            }

            $blog = $this->blogModel->getBlogById($id);

            // Kiểm tra nếu không tìm thấy bài viết
            if ($blog === false || !is_array($blog)) {
                throw new Exception("Blog post not found");
            }

            // Kiểm tra trạng thái hiển thị (nếu có)
            if (isset($blog['is_visible']) && !$blog['is_visible']) {
                throw new Exception("Blog post is hidden");
            }

            renderView("view/blog/blog_detail.php", compact('blog'), "detail blog");
        } catch (Exception $e) {
            $errors = ["Error fetching blog post: " . $e->getMessage()];
            renderView("view/blog/blog_detail.php", compact('errors'), "detail blog");
        }
    }
    public function create()
    {
        $errors = [];
        $title = '';
        $content = '';
        $author = '';
        $image = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['name'] ?? '');
            $content = trim($_POST['content'] ?? '');
            $author = trim($_POST['author'] ?? '');
            $image = $_FILES['image'] ?? null;

            if (empty($title)) $errors[] = "Title is required";
            if (empty($content)) $errors[] = "Content is required";
            if (empty($author)) $errors[] = "Author is required";
            if (empty($image['name'])) {
                $errors[] = "Image is required";
            } else {
                if ($image['size'] > 5 * 1024 * 1024) {
                    $errors[] = "Image size must not exceed 5MB";
                }
                $targetDir = "uploads/";
                if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);
                $fileName = time() . "_" . basename($image['name']);
                $targetFile = $targetDir . $fileName;
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                if (!in_array($imageFileType, $allowedTypes)) {
                    $errors[] = "Invalid image type. Only JPG, JPEG, PNG, and GIF are allowed.";
                }
            }

            if (empty($errors)) {
                if (move_uploaded_file($image['tmp_name'], $targetFile)) {
                    try {
                        $this->blogModel->createBlog($title, $content, $author, $targetFile);
                        $_SESSION['success_message'] = "Blog post created successfully!";
                        header("Location: /blog");
                        exit;
                    } catch (Exception $e) {
                        $errors[] = "Database error: " . $e->getMessage();
                    }
                } else {
                    $errors[] = "Error uploading file.";
                }
            }
        }
        renderAdminView("view/blog/create.php", compact('errors', 'title', 'author', 'content'), "Create Blog");
    }

    public function edit($id)
    {
        if (!is_numeric($id)) die("Invalid blog ID");
        $blog = $this->blogModel->getBlogById($id);
        if (!$blog) die("Blog post not found");

        $errors = [];
        $title = $blog['title'];
        $content = $blog['content'];
        $author = $blog['author'];
        $imagePath = $blog['image'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['name'] ?? '');
            $content = trim($_POST['content'] ?? '');
            $author = trim($_POST['author'] ?? '');
            $image = $_FILES['image'] ?? null;

            if (empty($title)) $errors[] = "Title is required";
            if (empty($content)) $errors[] = "Content is required";
            if (empty($author)) $errors[] = "Author is required";

            if (!empty($image['name'])) {
                if ($image['size'] > 5 * 1024 * 1024) {
                    $errors[] = "Image size must not exceed 5MB";
                } else {
                    $targetDir = "uploads/";
                    if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);
                    $fileName = time() . "_" . basename($image['name']);
                    $targetFile = $targetDir . $fileName;
                    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                    if (!in_array($imageFileType, $allowedTypes)) {
                        $errors[] = "Invalid image type.";
                    } else {
                        if (move_uploaded_file($image['tmp_name'], $targetFile)) {
                            $imagePath = $targetFile;
                        } else {
                            $errors[] = "Error uploading new image.";
                        }
                    }
                }
            }

            if (empty($errors)) {
                try {
                    $this->blogModel->updateBlog($id, $title, $content, $author, $imagePath);
                    $_SESSION['success_message'] = "Blog post updated successfully!";
                    header("Location: /blog");
                    exit;
                } catch (Exception $e) {
                    $errors[] = "Database error: " . $e->getMessage();
                }
            }
        }
        renderAdminView("view/blog/blog_edit.php", compact('errors', 'blog', 'title', 'content', 'author', 'imagePath'), "Edit Blog");
    }

    public function delete($id)
    {
        if (!is_numeric($id)) die("Invalid blog ID");
        $this->blogModel->deleteBlog($id);
        $_SESSION['success_message'] = "Blog post deleted successfully!";
        header("Location: /blog");
        exit;
    }

    // Phương thức toggle ẩn/hiện
    public function toggleVisibility($id)
    {
        if (!is_numeric($id)) die("Invalid blog ID");
        $blog = $this->blogModel->getBlogById($id);
        if (!$blog) die("Blog post not found");

        try {
            $this->blogModel->toggleVisibility($id);
            $_SESSION['success_message'] = "Blog visibility updated successfully!";
            header("Location: /blog/index1"); // Quay lại danh sách admin
            exit;
        } catch (Exception $e) {
            $_SESSION['error_message'] = "Error updating visibility: " . $e->getMessage();
            header("Location: /blog/index1");
            exit;
        }
    }
}
