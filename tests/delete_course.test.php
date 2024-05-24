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
    include 'delete_course.php';
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
    include 'delete_course.php';
    echo 'Test 2 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Payload missing') {
        echo 'Test 2 passed';
    } else {
        echo 'Test 2 failed';
    }
}

// Test case 3: Course successfully deleted

$_USER = ['is_admin' => true];
$_POST = ['course' => '1234567890123456'];

try {
    include 'delete_course.php';
    echo 'Test 3 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Routed to course_management') {
        echo 'Test 3 passed';
    } else {
        echo 'Test 3 failed';
    }
}