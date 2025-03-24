<?php
require_once "model/CategoryModel.php";
require_once "view/helpers.php";

class CategoryController
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $categories = $this->categoryModel->getAllcategories();
        //compact: gom bien dien thanh array
        renderAdminView("view/category/category_list.php", compact('categories'), "Category List");
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once "model/ValidateModel.php";

            $validate = new Validate();
            $name = $_POST['name'];

            // Kiểm tra dữ liệu
            $validate->checkRequired('name', $name, "Category name is required.");
            // $validate->checkLength('name', $name, 3, 50, "Category name must be between 3 and 50 characters.");

            if ($validate->passed()) {
                // Nếu dữ liệu hợp lệ, thêm vào cơ sở dữ liệu
                $this->categoryModel->createCategory($name);
                $_SESSION['success_message'] = "Category created successfully!";
                header("Location: /categories");
            } else {
                // Nếu dữ liệu không hợp lệ, hiển thị lỗi
                $errors = $validate->getErrors();
                renderAdminView("view/category/category_create.php", compact('errors'), "Create category");
            }
        } else {
            renderAdminView("view/category/category_create.php", [], "Create category");
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];

            $this->categoryModel->updateCategory($id, $name);
            header("Location: /categories");
        } else {
            $category = $this->categoryModel->getCategoryById($id);
            renderAdminView("view/category/category_edit.php", compact('category'), "Edit Category");
        }
    }
    
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Thực hiện xóa danh mục
            $this->categoryModel->deleteCategory($id);
            $_SESSION['success_message'] = "Category deleted successfully!";
            header("Location: /categories");
            exit;
        } else {
            // Chuyển hướng về trang danh mục nếu không phải yêu cầu POST
            header("Location: /categories");
            exit;
        }
    }    
}
