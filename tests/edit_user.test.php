<?php

// Mocking functions

function message($message, $type) {
    throw new Exception($message);
}

function str_fit($pattern, $str) {
    return preg_match("/$pattern/", $str);
}

function str_len($str) {
    return strlen($str);
}

function str_wash($str, $type = null) {
    return $str;
}

// Test1: Access denied for non-admin

$_USER = ['is_admin' => false];

try {
    include 'edit_user.php';
    echo 'Test 1 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Access denied') {
        echo 'Test 1 passed';
    } else {
        echo 'Test 1 failed';
    }
}

// Test case 2: Payload missing

$_USER = ['is_admin' => true];
$_POST = [];

try {
    include 'edit_user.php';
    echo 'Test 2 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Payload missing') {
        echo 'Test 2 passed';
    } else {
        echo 'Test 2 failed';
    }
}

// Test case 3: Invalid email address

$_USER = ['is_admin' => true];
$_POST = ['user' => '1234567890123456', 'email' => 'invalid', 'full_name' => 'Test User', 'address' => 'Test Address', 'phone' => '1234567890', 'is_student' => '1', 'is_lecturer' => '1', 'is_admin' => '1', 'password' => 'password', 'password_confirm' => 'password'];

try {
    include 'edit_user.php';
    echo 'Test 3 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Please provide a valid email address') {
        echo 'Test 3 passed';
    } else {
        echo 'Test 3 failed';
    }
}

// Test case 4: Full name missing

$_USER = ['is_admin' => true];
$_POST = ['user' => '1234567890123456', 'email' => 'test@example.com', 'full_name' => '', 'address' => 'Test Address', 'phone' => '1234567890', 'is_student' => '1', 'is_lecturer' => '1', 'is_admin' => '1', 'password' => 'password', 'password_confirm' => 'password'];

try {
    include 'edit_user.php';
    echo 'Test 4 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Please provide user\'s full name') {
        echo 'Test 4 passed';
    } else {
        echo 'Test 4 failed';
    }
}

// Test case 5: Self-unassign admin privileges

$_USER = ['is_admin' => true, 'id' => '1234567890123456'];
$_POST = ['user' => '1234567890123456', 'email' => 'test@example.com', 'full_name' => 'Test User', 'address' => 'Test Address', 'phone' => '1234567890', 'is_student' => '1', 'is_lecturer' => '1', 'is_admin' => '0', 'password' => 'password', 'password_confirm' => 'password'];

try {
    include 'edit_user.php';
    echo 'Test 5 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'You cannot self-unassign admin privileges') {
        echo 'Test 5 passed';
    } else {
        echo 'Test 5 failed';
    }
}

// Test case 6: Password too short

$_USER = ['is_admin' => true];
$_POST = ['user' => '1234567890123456', 'email' => 'test@example.com', 'full_name' => 'Test User', 'address' => 'Test Address', 'phone' => '1234567890', 'is_student' => '1', 'is_lecturer' => '1', 'is_admin' => '1', 'password' => 'short', 'password_confirm' => 'short'];

try {
    include 'edit_user.php';
    echo 'Test 6 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Please provide a password at least 8 characters long') {
        echo 'Test 6 passed';
    } else {
        echo 'Test 6 failed';
    }
}

// Test case 7: Password fields do not match

$_USER = ['is_admin' => true];
$_POST = ['user' => '1234567890123456', 'email' => 'test@example.com', 'full_name' => 'Test User', 'address' => 'Test Address', 'phone' => '1234567890', 'is_student' => '1', 'is_lecturer' => '1', 'is_admin' => '1', 'password' => 'password', 'password_confirm' => 'different'];

try {
    include 'edit_user.php';
    echo 'Test 7 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Password fields do not match') {
        echo 'Test 7 passed';
    } else {
        echo 'Test 7 failed';
    }
}