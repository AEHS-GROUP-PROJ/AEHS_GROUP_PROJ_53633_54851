<?php

// Mocking functions

function message($message, $type) {
    throw new Exception($message);
}

function sql($query, $type) {
    global $mock_sql_result;
    return $mock_sql_result;
}

function route($route) {
    throw new Exception("Redirected to $route");
}

// Test case 1: Student not enrolled in the course

$mock_sql_result = false;
$_POST['attendance'] = '1';

try {
    include 'check_attendance.php';
    echo 'Test 1 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'The student is not enrolled in the course') {
        echo 'Test 1 passed';
    } else {
        echo 'Test 1 failed';
    }
}

// Test case 2: Marking student as present

$mock_sql_result = true;
$_POST['attendance'] = '1';

try {
    include 'check_attendance.php';
    echo 'Test 2 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Attendance updated') {
        echo 'Test 2 passed';
    } else {
        echo 'Test 2 failed';
    }
}

// Test case 3: Marking student as absent

$mock_sql_result = true;
$_POST['attendance'] = '0';

try {
    include 'check_attendance.php';
    echo 'Test 3 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Attendance updated') {
        echo 'Test 3 passed';
    } else {
        echo 'Test 3 failed';
    }
}