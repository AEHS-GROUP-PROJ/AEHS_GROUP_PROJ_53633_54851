<?php

// Mocking functions

function message($message, $type) {
    throw new Exception($message);
}

function sql($query, $type) {
    global $mock_sql_result;
    return $mock_sql_result;
}

function sql_escape($str, $length) {
    return $str;
}

function str_rand($length) {
    return str_repeat('a', $length);
}

function route($route) {
    throw new Exception("Routed to $route");
}

// Test1: Payload missing

$_POST = [];

try {
    include 'signin.php';
    echo 'Test 1 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Payload missing') {
        echo 'Test 1 passed';
    } else {
        echo 'Test 1 failed';
    }
}

// Test case 2: Password is invalid

$_POST = ['email' => 'test@example.com', 'password' => 'password'];
$mock_sql_result = false;

try {
    include 'signin.php';
    echo 'Test 2 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Password is invalid') {
        echo 'Test 2 passed';
    } else {
        echo 'Test 2 failed';
    }
}

// Test case 3: Failed to create a session

$_POST = ['email' => 'test@example.com', 'password' => 'password'];
$mock_sql_result = ['id' => '1234567890123456'];

try {
    include 'signin.php';
    echo 'Test 3 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Failed to create a session') {
        echo 'Test 3 passed';
    } else {
        echo 'Test 3 failed';
    }
}

// Test case 4: Sign in successful

$_POST = ['email' => 'test@example.com', 'password' => 'password'];
$mock_sql_result = ['id' => '1234567890123456'];
$_SERVER['REMOTE_ADDR'] = '127.0.0.1';
$_SERVER['HTTP_USER_AGENT'] = 'Test User Agent';

try {
    include 'signin.php';
    echo 'Test 4 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'You are now signed in') {
        echo 'Test 4 passed';
    } else {
        echo 'Test 4 failed';
    }
}