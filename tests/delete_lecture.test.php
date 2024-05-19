<?php

// Mocking functions

function message($message, $type) {
    throw new Exception($message);
}

function str_fit($pattern, $str) {
    return preg_match("/$pattern/", $str);
}

function sql($query, $type) {
    if (strpos($query, 'attendance') !== false) {
        return false; // Assume no attendance records for testing
    }
    return true;
}

function route($route) {
    throw new Exception('Routed to ' . $route);
}

// Test case 1: Access denied for non-admin and non-lecturer

$_USER = ['is_admin' => false, 'is_lecturer' => false];

try {
    include 'delete_lecture.php';
    echo 'Test 1 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Access denied') {
        echo 'Test 1 passed';
    } else {
        echo 'Test 1 failed';
    }
}

// Test case 2: Payload missing

$_USER = ['is_admin' => true, 'is_lecturer' => false];
$_POST = [];

try {
    include 'delete_lecture.php';
    echo 'Test 2 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Payload missing') {
        echo 'Test 2 passed';
    } else {
        echo 'Test 2 failed';
    }
}

// Test case 3: Lecture successfully deleted

$_USER = ['is_admin' => true, 'is_lecturer' => false];
$_POST = ['lecture' => '1234567890123456'];

try {
    include 'delete_lecture.php';
    echo 'Test 3 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Routed to lecture_schedule') {
        echo 'Test 3 passed';
    } else {
        echo 'Test 3 failed';
    }
}