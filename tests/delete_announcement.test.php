<?php
// Mocking functions
function message($message, $type) {
    throw new Exception($message);
}

function str_len($str) {
    return strlen($str);
}

function str_wash($str) {
    return trim($str);
}

// Test case 1: Payload missing
$_POST = [];
try {
    include 'create_user.php';
    echo 'Test 1 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Payload missing') {
        echo 'Test 1 passed';
    } else {
        echo 'Test 1 failed';
    }
}

// Test case 2: Invalid email address
$_POST = ['email' => 'invalid email', 'full_name' => 'Full Name', 'address' => 'Address', 'phone' => '1234567890', 'is_student' => true, 'is_lecturer' => false, 'is_admin' => false, 'password' => 'password', 'password_confirm' => 'password'];
try {
    include 'create_user.php';
    echo 'Test 2 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Please provide a valid email address') {
        echo 'Test 2 passed';
    } else {
        echo 'Test 2 failed';
    }
}

// Test case 3: Full name missing
$_POST = ['email' => 'email@example.com', 'full_name' => '', 'address' => 'Address', 'phone' => '1234567890', 'is_student' => true, 'is_lecturer' => false, 'is_admin' => false, 'password' => 'password', 'password_confirm' => 'password'];
try {
    include 'create_user.php';
    echo 'Test 3 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Please provide user\'s full name') {
        echo 'Test 3 passed';
    } else {
        echo 'Test 3 failed';
    }
}

// Test case 4: Password too short
$_POST = ['email' => 'email@example.com', 'full_name' => 'Full Name', 'address' => 'Address', 'phone' => '1234567890', 'is_student' => true, 'is_lecturer' => false, 'is_admin' => false, 'password' => 'short', 'password_confirm' => 'short'];
try {
    include 'create_user.php';
    echo 'Test 4 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Please provide a password at least 8 characters long') {
        echo 'Test 4 passed';
    } else {
        echo 'Test 4 failed';
    }
}