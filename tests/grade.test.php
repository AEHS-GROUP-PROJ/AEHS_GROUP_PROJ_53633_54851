<?php

// Mocking functions

function message($message, $type) {
    throw new Exception($message);
}

function str_fit($pattern, $str) {
    return preg_match("/$pattern/", $str);
}

function sql($query, $type) {
    global $mock_sql_result;
    return $mock_sql_result;
}

function route($route) {
    throw new Exception("Routed to $route");
}

// Test1: Access denied for non-lecturer

$_USER = ['is_lecturer' => false];

try {
    include 'grade.php';
    echo 'Test 1 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Access denied') {
        echo 'Test 1 passed';
    } else {
        echo 'Test 1 failed';
    }
}

// Test case 2: Payload missing

$_USER = ['is_lecturer' => true];
$_POST = [];

try {
    include 'grade.php';
    echo 'Test 2 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Payload missing') {
        echo 'Test 2 passed';
    } else {
        echo 'Test 2 failed';
    }
}

// Test case 3: Assignment submission does not exist

$_USER = ['is_lecturer' => true];
$_POST = ['assignment' => '1234567890123456', 'student' => '1234567890123456', 'grade' => '10'];
$mock_sql_result = false;

try {
    include 'grade.php';
    echo 'Test 3 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'The assignment submission does not exist') {
        echo 'Test 3 passed';
    } else {
        echo 'Test 3 failed';
    }
}

// Test case 4: Grade has been updated

$_USER = ['is_lecturer' => true];
$_POST = ['assignment' => '1234567890123456', 'student' => '1234567890123456', 'grade' => '10'];
$mock_sql_result = true;

try {
    include 'grade.php';
    echo 'Test 4 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Grade has been updated') {
        echo 'Test 4 passed';
    } else {
        echo 'Test 4 failed';
    }
}