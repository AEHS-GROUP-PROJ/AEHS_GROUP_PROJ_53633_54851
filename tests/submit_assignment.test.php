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

function str_fit($pattern, $str) {
    return preg_match("/$pattern/", $str);
}

function str_len($str) {
    return strlen($str);
}

function str_wash($str, $type) {
    return $str;
}

function route($route) {
    throw new Exception("Routed to $route");
}

// Test case 1: Payload missing

$_POST = [];

try {
    include 'submit_assignment.php';
    echo 'Test 1 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Payload missing') {
        echo 'Test 1 passed';
    } else {
        echo 'Test 1 failed';
    }
}

// Test case 2: Assignment not found

$_POST = ['assignment' => '1234567890123456', 'text' => 'Test text'];
$mock_sql_result = false;

try {
    include 'submit_assignment.php';
    echo 'Test 2 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Assignment not found') {
        echo 'Test 2 passed';
    } else {
        echo 'Test 2 failed';
    }
}

// Test case 3: The deadline has passed

$_POST = ['assignment' => '1234567890123456', 'text' => 'Test text'];
$mock_sql_result = ['deadline' => '2000-01-01 00:00:00'];

try {
    include 'submit_assignment.php';
    echo 'Test 3 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'The deadline has passed') {
        echo 'Test 3 passed';
    } else {
        echo 'Test 3 failed';
    }
}

// Test case 4: No content provided

$_POST = ['assignment' => '1234567890123456', 'text' => ''];
$mock_sql_result = ['deadline' => '2099-12-31 23:59:59'];

try {
    include 'submit_assignment.php';
    echo 'Test 4 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Please provide some content') {
        echo 'Test 4 passed';
    } else {
        echo 'Test 4 failed';
    }
}