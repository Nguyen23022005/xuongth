<?php
require_once "model/DiscountModel.php";
require_once "view/helpers.php";

class DiscountController
{
    private $discountModel;

    public function __construct()
    {
        $this-> discountModel = new DiscountModel();
    }

    public function index()
    {
        $discounts = $this-> discountModel->getAlldiscounts();
        //compact: gom bien dien thanh array
        renderAdminView("view/discounts/list.php", compact('discounts'), "Category List");
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once "model/ValidateModel.php";

            $validate = new Validate();
            $code = $_POST['code'];
            $discount_value = $_POST['discount_value'];
            $usage_limit = $_POST['usage_limit'];
            $end_date = $_POST['end_date'];
            // Kiểm tra dữ liệu
            $validate->checkRequired('code', $code, "Discounts code is required.");
            $validate->checkRequired('discount_value', $discount_value, "Discount value is required.");
            $validate->checkRequired('usage_limit', $usage_limit, "Usage limit is required.");
            $validate->checkRequired('end_date', $end_date, "End date is required.");
            // $validate->checkLength('name', $name, 3, 50, "Category name must be between 3 and 50 characters.");

            if ($validate->passed()) {
                // Nếu dữ liệu hợp lệ, thêm vào cơ sở dữ liệu
                $this-> discountModel->creatediscounts($code, $discount_value, $usage_limit, $end_date);
                $_SESSION['success_message'] = "Category created successfully!";
                header("Location: /discounts");
            } else {
                // Nếu dữ liệu không hợp lệ, hiển thị lỗi
                $errors = $validate->getErrors();
                renderAdminView("view/discounts/create.php", compact('errors'), "Create category");
            }
        } else {
            renderAdminView("view/discounts/create.php", [], "Create category");
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $code = $_POST['code'];
            $discount_value = $_POST['discount_value'];
            $usage_limit = $_POST['usage_limit'];
            $end_date = $_POST['end_date'];
            $this-> discountModel->updatediscounts($id, $code,$discount_value, $usage_limit, $end_date);
            header("Location: /discounts");
        } else {
            $discount = $this-> discountModel->getdiscountById($id);
            renderAdminView("view/discounts/edit.php", compact('discount'), "Edit Category");
        }
    }
    
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Thực hiện xóa danh mục
            $this-> discountModel->deletediscounts($id);
            $_SESSION['success_message'] = "discounts deleted successfully!";
            header("Location: /discounts");
            exit;
        } else {
            // Chuyển hướng về trang danh mục nếu không phải yêu cầu POST
            header("Location: /discounts");
            exit;
        }
    }    
}
