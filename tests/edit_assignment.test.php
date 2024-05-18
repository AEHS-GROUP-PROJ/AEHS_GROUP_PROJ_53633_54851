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
    if (strpos($query, 'SELECT 1 FROM `courses`') !== false) {
        return true; // Assume course exists for testing
    }
    if (strpos($query, 'SELECT 1 FROM `assignments`') !== false) {
        return false; // Assume assignment does not exist for testing
    }
    return true;
}

function sql_escape($str, $length) {
    return $str;
}

function route($route) {
    throw new Exception('Routed to ' . $route);
}

// Test case 1: Invalid course
$_POST = ['course' => 'invalid', 'title' => 'Test Title', 'deadline' => '2022-12-31T23:59', 'assignment' => '1234567890123456'];
try {
    include 'edit_assignment.php';
    echo 'Test 1 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Please select an ongoing course') {
        echo 'Test 1 passed';
    } else {
        echo 'Test 1 failed';
    }
}

// Test case 2: Title missing
$_POST = ['course' => '1234567890123456', 'title' => '', 'deadline' => '2022-12-31T23:59', 'assignment' => '1234567890123456'];
try {
    include 'edit_assignment.php';
    echo 'Test 2 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Please provide assignment\'s title') {
        echo 'Test 2 passed';
    } else {
        echo 'Test 2 failed';
    }
}

// Test case 3: Assignment already exists
$_POST = ['course' => '1234567890123456', 'title' => 'Test Title', 'deadline' => '2022-12-31T23:59', 'assignment' => '1234567890123456'];
function sql($query, $type) {
    if (strpos($query, 'SELECT 1 FROM `assignments`') !== false) {
        return true; // Assume assignment exists for testing
    }
    return true;
}
try {
    include 'edit_assignment.php';
    echo 'Test 3 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Assignment already exists') {
        echo 'Test 3 passed';
    } else {
        echo 'Test 3 failed';
    }
}

// Test case 4: Invalid deadline
$_POST = ['course' => '1234567890123456', 'title' => 'Test Title', 'deadline' => 'invalid', 'assignment' => '1234567890123456'];
function sql($query, $type) {
    if (strpos($query, 'SELECT 1 FROM `assignments`') !== false) {
        return false; // Assume assignment does not exist for testing
    }
    return true;
}
try {
    include 'edit_assignment.php';
    echo 'Test 4 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Please provide assignment\'s deadline') {
        echo 'Test 4 passed';
    } else {
        echo 'Test 4 failed';
    }
}

// Test case 5: Deadline too early
$_POST = ['course' => '1234567890123456', 'title' => 'Test Title', 'deadline' => date('Y-m-d\TH:i', strtotime('00:00')), 'assignment' => '1234567890123456'];
try {
    include 'edit_assignment.php';
    echo 'Test 5 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Updated deadline can\'t be earlier than tomorrow') {
        echo 'Test 5 passed';
    } else {
        echo 'Test 5 failed';
    }
}

// Test case 6: Assignment successfully updated
$_POST = ['course' => '1234567890123456', 'title' => 'Test Title', 'deadline'];