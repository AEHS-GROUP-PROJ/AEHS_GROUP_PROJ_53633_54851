<?php

// Mocking functions

function message($message, $type) {
    throw new Exception($message);
}

function str_fit($pattern, $str) {
    return preg_match("/$pattern/", $str);
}

function sql($query, $type) {
    if (strpos($query, 'SELECT 1 FROM `enrolments`') !== false) {
        return true; // Assume enrolment exists for testing
    }
    return true;
}

function route($route) {
    throw new Exception('Routed to ' . $route);
}

// Test case 1: Access denied for non-admin

$_USER = ['is_admin' => false];

try {
    include 'dropout.php';
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
    include 'dropout.php';
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
$_POST = ['student' => '1234567890123456', 'course' => '1234567890123456'];
function sql($query, $type) {
    if (strpos($query, 'SELECT 1 FROM `enrolments`') !== false) {
        return false; // Assume enrolment does not exist for testing
    }
    return true;
}

try {
    include 'dropout.php';
    echo 'Test 3 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'The enrolment does not exist') {
        echo 'Test 3 passed';
    } else {
        echo 'Test 3 failed';
    }
}

// Test case 4: Student successfully dropped out

$_USER = ['is_admin' => true];
$_POST = ['student' => '1234567890123456', 'course' => '1234567890123456'];
function sql($query, $type) {
    if (strpos($query, 'SELECT 1 FROM `enrolments`') !== false) {
        return true; // Assume enrolment exists for testing
    }
    return true;
}

try {
    include 'dropout.php';
    echo 'Test 4 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'The student has been dropped out') {
        echo 'Test 4 passed';
    } else {
        echo 'Test 4 failed';
    }
}