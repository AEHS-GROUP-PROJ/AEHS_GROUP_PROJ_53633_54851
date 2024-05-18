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

// Test case 1: Course not available
$mock_sql_result = false;
try {
    include 'apply.php';
    echo 'Test 1 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Sorry, the course is not available') {
        echo 'Test 1 passed';
    } else {
        echo 'Test 1 failed';
    }
}

// Test case 2: Failed to create an enrolment
$mock_sql_result = true;
$_USER = ['id' => '1234567890'];
$_POST = ['course' => '1234567890'];
try {
    include 'apply.php';
    echo 'Test 2 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Failed to create an enrolment') {
        echo 'Test 2 passed';
    } else {
        echo 'Test 2 failed';
    }
}

// Test case 3: Successfully applied for the course
$mock_sql_result = true;
try {
    include 'apply.php';
    echo 'Test 3 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'You have successfully applied for the course') {
        echo 'Test 3 passed';
    } else {
        echo 'Test 3 failed';
    }
}