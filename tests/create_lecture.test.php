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

function str_fit($pattern, $str, $type) {
    return preg_match("/$pattern/", $str);
}

// Test case 1: Access denied for non-admin and non-lecturer
$_USER = ['is_admin' => false, 'is_lecturer' => false];
try {
    include 'create_lecture.php';
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
    include 'create_lecture.php';
    echo 'Test 2 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Payload missing') {
        echo 'Test 2 passed';
    } else {
        echo 'Test 2 failed';
    }
}

// Test case 3: Lecture title missing
$_USER = ['is_admin' => true, 'is_lecturer' => false];
$_POST = ['title' => '', 'starts_at' => '2022-01-01T00:00', 'course' => 'Course', 'lecturer' => 'Lecturer', 'location' => 'Location'];
try {
    include 'create_lecture.php';
    echo 'Test 3 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Please provide lecture\'s title') {
        echo 'Test 3 passed';
    } else {
        echo 'Test 3 failed';
    }
}

// Test case 4: Invalid start date and time format
$_USER = ['is_admin' => true, 'is_lecturer' => false];
$_POST = ['title' => 'Lecture title', 'starts_at' => 'invalid format', 'course' => 'Course', 'lecturer' => 'Lecturer', 'location' => 'Location'];
try {
    include 'create_lecture.php';
    echo 'Test 4 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Please provide lecture\'s start date and time') {
        echo 'Test 4 passed';
    } else {
        echo 'Test 4 failed';
    }
}