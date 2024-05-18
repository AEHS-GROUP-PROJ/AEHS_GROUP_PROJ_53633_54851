<?php
// Mocking functions
function message($message, $type) {
    throw new Exception($message);
}

function sql($query, $type) {
    global $mock_sql_result;
    return $mock_sql_result;
}

function sql_escape($str, $length) {
    return substr($str, 0, $length);
}

function route($route) {
    throw new Exception("Redirected to $route");
}

// Test case 1: Failed to create a classroom
$mock_sql_result = false;
$_POST = ['title' => 'Classroom title', 'location' => 'Classroom location', 'capacity' => '100'];
try {
    include 'create_classroom.php';
    echo 'Test 1 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Failed to create a classroom') {
        echo 'Test 1 passed';
    } else {
        echo 'Test 1 failed';
    }
}

// Test case 2: Successfully created a classroom
$mock_sql_result = true;
try {
    include 'create_classroom.php';
    echo 'Test 2 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Classroom successfully created') {
        echo 'Test 2 passed';
    } else {
        echo 'Test 2 failed';
    }
}