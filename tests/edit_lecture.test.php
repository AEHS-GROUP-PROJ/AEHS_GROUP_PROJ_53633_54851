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
    if (strpos($query, 'SELECT 1 FROM `courses` WHERE `courses`.id=') !== false) {
        return true; // Assume course exists for testing
    }
    return false;
}

// Test1: Access denied for non-admin and non-lecturer
$_USER = ['is_admin' => false, 'is_lecturer' => false];
try {
    include 'edit_lecture.php';
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
    include 'edit_lecture.php';
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
$_POST = ['lecture' => '1234567890123456', 'title' => '', 'starts_at' => '2022-01-01T00:00', 'course' => '1234567890123456', 'lecturer' => '1234567890123456', 'location' => 'Test Location'];
try {
    include 'edit_lecture.php';
    echo 'Test 3 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Please provide lecture\'s title') {
        echo 'Test 3 passed';
    } else {
        echo 'Test 3 failed';
    }
}

// Test case 4: Invalid start date and time
$_USER = ['is_admin' => true];
$_POST = ['lecture' => '1234567890123456', 'title' => 'Test Title', 'starts_at' => 'invalid', 'course' => '1234567890123456', 'lecturer' => '1234567890123456', 'location' => 'Test Location'];
try {
    include 'edit_lecture.php';
    echo 'Test 4 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Please provide lecture\'s start date and time') {
        echo 'Test 4 passed';
    } else {
        echo 'Test 4 failed';
    }
}

// Test case 5: Lecture starts earlier than tomorrow
$_USER = ['is_admin' => true];
$_POST = ['lecture' => '1234567890123456', 'title' => 'Test Title', 'starts_at' => date('Y-m-d\TH:i', strtotime('-1 day')), 'course' => '1234567890123456', 'lecturer' => '1234567890123456', 'location' => 'Test Location'];
try {
    include 'edit_lecture.php';
    echo 'Test 5 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Updated lecture can\'t start earlier than tomorrow') {
        echo 'Test 5 passed';
    } else {
        echo 'Test 5 failed';
    }
}

// Test case 6: Course does not exist
$_USER = ['is_admin' => true];
$_POST = ['lecture' => '1234567890123456', 'title' => 'Test Title', 'starts_at' => date('Y-m-d\TH:i', strtotime('+1 day')), 'course' => '1234567890123456', 'lecturer' => '1234567890123456', 'location' => 'Test Location'];
function sql($query, $type) {
    if (strpos($query, 'SELECT 1 FROM `courses` WHERE `courses`.id=') !== false) {
        return false; // Assume course does not exist for testing
    }
    return false;
}
try {
    include 'edit_lecture.php';
    echo 'Test 6 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Please select an existing course') {
        echo 'Test 6 passed';
    } else {
        echo 'Test 6 failed';
    }
}