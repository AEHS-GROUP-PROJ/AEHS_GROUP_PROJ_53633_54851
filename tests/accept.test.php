<?php
// Mocking functions
function message($message, $type) {
    throw new Exception($message);
}

function sql($query, $type) {
    global $mock_sql_result;
    return $mock_sql_result;
}

function route($route) {
    throw new Exception("Redirected to $route");
}

// Test case 1: Access denied for non-admin
$_USER = ['is_admin' => false];
try {
    include 'accept.php';
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
    include 'accept.php';
    echo 'Test 2 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Payload missing') {
        echo 'Test 2 passed';
    } else {
        echo 'Test 2 failed';
    }
}

// Test case 3: Enrolment does not exist
$_USER = ['is_admin' => true];
$_POST = ['student' => '1234567890', 'course' => '1234567890'];
$mock_sql_result = false;
try {
    include 'accept.php';
    echo 'Test 3 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'The enrolment does not exist') {
        echo 'Test 3 passed';
    } else {
        echo 'Test 3 failed';
    }
}