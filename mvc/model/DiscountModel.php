<?php
require_once "Database.php";

class DiscountModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAlldiscounts()
    {
        $query = "SELECT * FROM discounts";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getdiscountById($id)
    {
        $query = "SELECT * FROM discounts WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function creatediscounts($code, $discount_value, $usage_limit, $end_date)
    {
        $query = "INSERT INTO discounts (code,discount_value,usage_limit,end_date ) VALUES (:code,:discount_value,:usage_limit,:end_date)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':discount_value', $discount_value);
        $stmt->bindParam(':usage_limit', $usage_limit);
        $stmt->bindParam(':end_date', $end_date);
        return $stmt->execute();
    }

    public function updateDiscounts($id, $code, $discount_value, $usage_limit, $end_date)
    {
        $query = "UPDATE discounts 
              SET code = :code, 
                  discount_value = :discount_value, 
                  usage_limit = :usage_limit, 
                  end_date = :end_date  
              WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':code', $code, PDO::PARAM_STR);
        $stmt->bindParam(':discount_value', $discount_value, PDO::PARAM_STR);
        $stmt->bindParam(':usage_limit', $usage_limit, PDO::PARAM_INT);
        $stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function deletediscounts($id)
    {
        $query = "DELETE FROM discounts WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
