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

function str_fit($pattern, $str) {
    return preg_match("/$pattern/", $str);
}

// Test case 1: Access denied for non-admin

$_USER = ['is_admin' => false];

try {
    include 'create_course.php';
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
    include 'create_course.php';
    echo 'Test 2 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Payload missing') {
        echo 'Test 2 passed';
    } else {
        echo 'Test 2 failed';
    }
}

// Test case 3: Course title missing

$_USER = ['is_admin' => true];
$_POST = ['title' => '', 'start_date' => '2022-01-01', 'end_date' => '2022-12-31', 'places' => '100'];

try {
    include 'create_course.php';
    echo 'Test 3 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Please provide a course title') {
        echo 'Test 3 passed';
    } else {
        echo 'Test 3 failed';
    }
}

// Test case 4: Invalid start date format

$_USER = ['is_admin' => true];
$_POST = ['title' => 'Course title', 'start_date' => 'invalid format', 'end_date' => '2022-12-31', 'places' => '100'];

try {
    include 'create_course.php';
    echo 'Test 4 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Please provide a start date') {
        echo 'Test 4 passed';
    } else {
        echo 'Test 4 failed';
    }
}

// Test case 5: Start date earlier than tomorrow

$_USER = ['is_admin' => true];
$_POST = ['title' => 'Course title', 'start_date' => date('Y-m-d'), 'end_date' => '2022-12-31', 'places' => '100'];

try {
    include 'create_course.php';
    echo 'Test 5 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Start date can\'t be earlier than tomorrow') {
        echo 'Test 5 passed';
    } else {
        echo 'Test 5 failed';
    }
}