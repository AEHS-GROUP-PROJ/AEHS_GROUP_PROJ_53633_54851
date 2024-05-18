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
    return $str;
}

function str_fit($pattern, $str) {
    return preg_match("/$pattern/", $str);
}

function route($route) {
    throw new Exception("Routed to $route");
}

// Test1: No cookie set
$_COOKIE = [];
try {
    include 'signout.php';
    echo 'Test 1 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'You are now signed out') {
        echo 'Test 1 passed';
    } else {
        echo 'Test 1 failed';
    }
}

// Test case 2: Cookie set but not matching pattern
$_COOKIE = ['sis_token' => 'invalid_token'];
try {
    include 'signout.php';
    echo 'Test 2 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'You are now signed out') {
        echo 'Test 2 passed';
    } else {
        echo 'Test 2 failed';
    }
}

// Test case 3: Cookie set and matching pattern
$_COOKIE = ['sis_token' => 'abcdefghijklmnop'];
try {
    include 'signout.php';
    echo 'Test 3 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'You are now signed out') {
        echo 'Test 3 passed';
    } else {
        echo 'Test 3 failed';
    }
}