<?php

function isAdmin() {
    // Check if the user role is 'admin'
    if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
        return true;
    }
    echo "Access denied: Admin privileges required.";
    header("Location: /login");
    exit;
}
function x(){
    if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'quan'){
        return true;
    }
    echo "Access denied: Quanly privileges required.";
    header("Location: /login"); 
    exit;
}

function isUser() {
    if (isset($_SESSION['user'])) {
        return true;
    }
    header("Location: /login");
    exit;
}

function logRequest() {
    // Log the request for debugging or auditing
    error_log("Request received at " . date('Y-m-d H:i:s'));
    return true;
}
?>