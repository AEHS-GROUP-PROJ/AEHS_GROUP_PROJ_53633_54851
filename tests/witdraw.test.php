<?php

// Mocking functions

function message($message, $type) {
    throw new Exception($message);
}

function sql($query, $type) {
    global $mock_sql_result;
    return $mock_sql_result;
}

function str_fit($pattern, $str) {
    return preg_match("/$pattern/", $str);
}

function route($route) {
    throw new Exception("Routed to $route");
}

// Test1: Access denied

$_USER = ['is_student' => false];

try {
    include 'withdraw.php';
    echo 'Test 1 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Access denied') {
        echo 'Test 1 passed';
    } else {
        echo 'Test 1 failed';
    }
}

// Test case 2: Payload missing

$_USER = ['is_student' => true];
$_POST = [];

try {
    include 'withdraw.php';
    echo 'Test 2 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Payload missing') {
        echo 'Test 2 passed';
    } else {
        echo 'Test 2 failed';
    }
}

// Test case 3: Withdrawal unsuccessful

$_USER = ['is_student' => true, 'id' => '1234567890123456'];
$_POST = ['course' => '1234567890123456'];
$mock_sql_result = false;

try {
    include 'withdraw.php';
    echo 'Test 3 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Routed to my_courses') {
        echo 'Test 3 passed';
    } else {
        echo 'Test 3 failed';
    }
}

// Test case 4: Withdrawal successful

$_USER = ['is_student' => true, 'id' => '1234567890123456'];
$_POST = ['course' => '1234567890123456'];
$mock_sql_result = true;

try {
    include 'withdraw.php';
    echo 'Test 4 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'You have successfully withdrawn from the course') {
        echo 'Test 4 passed';
    } else {
        echo 'Test 4 failed';
    }
}