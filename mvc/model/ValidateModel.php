<?php

class Validate
{
    private $errors = [];

    public function checkRequired($field, $value, $message = "This field is required.")
    {
        if (empty($value)) {
            $this->errors[$field] = $message;
        }
    }

    public function checkEmail($field, $value, $message = "Invalid email address.")
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = $message;
        }
    }

    public function checkLength($field, $value, $min, $max, $message = "Invalid length.")
    {
        if (strlen($value) < $min || strlen($value) > $max) {
            $this->errors[$field] = $message;
        }
    }

    public function checkRange($field, $value, $min, $max, $message = "Invalid value range.")
    {
        if (!is_numeric($value) || $value < $min || $value > $max) {
            $this->errors[$field] = $message;
        }
    }

    // Thêm phương thức addError
    public function addError($field, $message)
    {
        $this->errors[$field] = $message;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function passed()
    {
        return empty($this->errors);
    }
}