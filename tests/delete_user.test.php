<?php

// Mocking functions

function message($message, $type) {
    throw new Exception($message);
}

function str_fit($pattern, $str) {
    return preg_match("/$pattern/", $str);
}

function sql($query, $type) {
    return true;
}

function route($route) {
    throw new Exception('Routed to ' . $route);
}

// Test case 1: Access denied for non-admin

$_USER = ['is_admin' => false];

try {
    include 'delete_user.php';
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
    include 'delete_user.php';
    echo 'Test 2 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Payload missing') {
        echo 'Test 2 passed';
    } else {
        echo 'Test 2 failed';
    }
}

// Test case 3: User tries to delete themselves

$_USER = ['is_admin' => true, 'id' => '1234567890123456'];
$_POST = ['user' => '1234567890123456'];

try {
    include 'delete_user.php';
    echo 'Test 3 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'You cannot delete yourself') {
        echo 'Test 3 passed';
    } else {
        echo 'Test 3 failed';
    }
}

// Test case 4: User successfully deleted

$_USER = ['is_admin' => true, 'id' => '1234567890123456'];
$_POST = ['user' => '1234567890123457'];

try {
    include 'delete_user.php';
    echo 'Test 4 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Routed to user_management') {
        echo 'Test 4 passed';
    } else {
        echo 'Test 4 failed';
    }
}