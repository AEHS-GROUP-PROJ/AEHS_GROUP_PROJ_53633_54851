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
    if (strpos($query, 'SELECT 1 FROM `classrooms`') !== false) {
        return false; // Assume classroom does not exist for testing
    }
    return true;
}

function sql_escape($str, $length) {
    return $str;
}

// Test case 1: Access denied for non-admin

$_USER = ['is_admin' => false];

try {
    include 'edit_classroom.php';
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
    include 'edit_classroom.php';
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
$_POST = ['classroom' => '1234567890123456', 'title' => '', 'location' => 'Test Location', 'capacity' => '30'];

try {
    include 'edit_classroom.php';
    echo 'Test 3 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Please provide classroom\'s title') {
        echo 'Test 3 passed';
    } else {
        echo 'Test 3 failed';
    }
}

// Test case 4: Location missing

$_USER = ['is_admin' => true];
$_POST = ['classroom' => '1234567890123456', 'title' => 'Test Title', 'location' => '', 'capacity' => '30'];

try {
    include 'edit_classroom.php';
    echo 'Test 4 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Please provide classroom\'s location') {
        echo 'Test 4 passed';
    } else {
        echo 'Test 4 failed';
    }
}

// Test case 5: Invalid capacity

$_USER = ['is_admin' => true];
$_POST = ['classroom' => '1234567890123456', 'title' => 'Test Title', 'location' => 'Test Location', 'capacity' => 'invalid'];

try {
    include 'edit_classroom.php';
    echo 'Test 5 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Please provide classroom\'s capacity') {
        echo 'Test 5 passed';
    } else {
        echo 'Test 5 failed';
    }
}

// Test case 6: Zero capacity

$_USER = ['is_admin' => true];
$_POST = ['classroom' => '1234567890123456', 'title' => 'Test Title', 'location' => 'Test Location', 'capacity' => '0'];

try {
    include 'edit_classroom.php';
    echo 'Test 6 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Classroom has to accomodate at least one student') {
        echo 'Test 6 passed';
    } else {
        echo 'Test 6 failed';
    }
}

// Test case 7: Classroom with such title already exists

$_USER = ['is_admin' => true];
$_POST = ['classroom' => '1234567890123456', 'title' => 'Test Title', 'location' => 'Test Location', 'capacity' => '30'];
function sql($query, $type) {
    if (strpos($query, 'SELECT 1 FROM `classrooms`') !== false) {
        return true; // Assume classroom exists for testing
    }
    return true;
}

try {
    include 'edit_classroom.php';
    echo 'Test 7 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Classroom with such title already exists') {
        echo 'Test 7 passed';
    } else {
        echo 'Test 7 failed';
    }
}

// Test case 8: Classroom successfully updated

$_USER = ['is_admin' => true];
$_POST = ['classroom' => '1234567890123456', 'title' => 'Test Title', 'location' => 'Test Location', 'capacity' => '30'];
function sql($query, $type) {
    if (strpos($query, 'SELECT 1 FROM `classrooms`') !== false) {
        return false; // Assume classroom does not exist for testing
    }
    return true;
}

try {
    include 'edit_classroom.php';
    echo 'Test 8 passed'; // No exception means the test passed
} catch (Exception $e) {
    echo 'Test 8 failed';
}