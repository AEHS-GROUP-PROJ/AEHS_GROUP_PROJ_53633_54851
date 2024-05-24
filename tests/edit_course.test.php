<?php

// Mocking functions

function message($message, $type) {
    throw new Exception($message);
}

function str_fit($pattern, $str) {
    return preg_match("/$pattern/", $str);
}

function str_len($str) {
    return strlen($str);
}

function str_wash($str, $type = null) {
    return $str;
}

function sql($query, $type) {
    if (strpos($query, 'SELECT `courses`.start_date FROM `courses`') !== false) {
        return ['start_date' => '2022-01-01']; // Assume course exists for testing
    }
    return false;
}

function route($route) {
    throw new Exception('Redirected to ' . $route);
}

// Test case 1: Access denied for non-admin

$_USER = ['is_admin' => false];

try {
    include 'edit_course.php';
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
    include 'edit_course.php';
    echo 'Test 2 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Payload missing') {
        echo 'Test 2 passed';
    } else {
        echo 'Test 2 failed';
    }
}

// Test case 3: Title missing

$_USER = ['is_admin' => true];
$_POST = ['course' => '1234567890123456', 'title' => '', 'start_date' => '2022-01-01', 'end_date' => '2022-12-31', 'places' => '30'];

try {
    include 'edit_course.php';
    echo 'Test 3 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Please provide a course title') {
        echo 'Test 3 passed';
    } else {
        echo 'Test 3 failed';
    }
}

// Test case 4: Invalid start date

$_USER = ['is_admin' => true];
$_POST = ['course' => '1234567890123456', 'title' => 'Test Title', 'start_date' => 'invalid', 'end_date' => '2022-12-31', 'places' => '30'];

try {
    include 'edit_course.php';
    echo 'Test 4 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Please provide a start date') {
        echo 'Test 4 passed';
    } else {
        echo 'Test 4 failed';
    }
}

// Test case 5: Course does not exist

$_USER = ['is_admin' => true];
$_POST = ['course' => '1234567890123456', 'title' => 'Test Title', 'start_date' => '2022-01-01', 'end_date' => '2022-12-31', 'places' => '30'];
function sql($query, $type) {
    if (strpos($query, 'SELECT `courses`.start_date FROM `courses`') !== false) {
        return false; // Assume course does not exist for testing
    }
    return false;
}

try {
    include 'edit_course.php';
    echo 'Test 5 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Course does not exist') {
        echo 'Test 5 passed';
    } else {
        echo 'Test 5 failed';
    }
}

// Test case 6: Start date can't be earlier than tomorrow

$_USER = ['is_admin' => true];
$_POST = ['course' => '1234567890123456', 'title' => 'Test Title', 'start_date' => '2022-01-01', 'end_date' => '2022-12-31', 'places' => '30'];
function sql($query, $type) {
    if (strpos($query, 'SELECT `courses`.start_date FROM `courses`') !== false) {
        return ['start_date' => date('Y-m-d', strtotime('+2 days'))]; // Assume course starts day after tomorrow for testing
    }
    return false;
}

try {
    include 'edit_course.php';
    echo 'Test 6 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Start date can\'t be earlier than tomorrow') {
        echo 'Test 6 passed';
    } else {
        echo 'Test 6 failed';
    }
}

// Test case 7: Invalid end date

$_USER = ['is_admin' => true];
$_POST = ['course' => '1234567890123456', 'title' => 'Test Title', 'start_date' => '2022-01-01', 'end_date' => 'invalid', 'places' => '30'];

try {
    include 'edit_course.php';
    echo 'Test 7 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Please provide an end date') {
        echo 'Test 7 passed';
    } else {
        echo 'Test 7 failed';
    }
}

// Test case 8: End date earlier than start date

$_USER = ['is_admin' => true];
$_POST = ['course' => '1234567890123456', 'title' => 'Test Title', 'start_date' => '2022-12-31', 'end_date' => '2022-01-01', 'places' => '30'];

try {
    include 'edit_course.php';
    echo 'Test 8 failed'; // No exception means the test failed
} catch (Exception $e) {
    echo 'Test 8 passed';
}