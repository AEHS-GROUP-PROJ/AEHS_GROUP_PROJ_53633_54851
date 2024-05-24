<?php

// Mocking functions

function message($message, $type) {
    throw new Exception($message);
}

function sql($query, $type) {
    global $mock_sql_result;
    return $mock_sql_result;
}

function str_len($str) {
    return strlen($str);
}

function str_wash($str, $type = null) {
    return trim($str);
}

// Test case 1: Access denied for non-admin and non-lecturer

$_USER = ['is_admin' => false, 'is_lecturer' => false];

try {
    include 'create_announcement.php';
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
    include 'create_announcement.php';
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
$_POST = ['title' => '', 'text' => 'Announcement text'];

try {
    include 'create_announcement.php';
    echo 'Test 3 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Please provide a title') {
        echo 'Test 3 passed';
    } else {
        echo 'Test 3 failed';
    }
}

// Test case 4: Announcement text missing

$_USER = ['is_admin' => true];
$_POST = ['title' => 'Announcement title', 'text' => ''];

try {
    include 'create_announcement.php';
    echo 'Test 4 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Please provide announcement text') {
        echo 'Test 4 passed';
    } else {
        echo 'Test 4 failed';
    }
}

// Test case 5: Creating an announcement record

$_USER = ['is_admin' => true];
$_POST = ['title' => 'Announcement title', 'text' => 'Announcement text'];
$mock_sql_result = true;

try {
    include 'create_announcement.php';
    echo 'Test 5 passed';
} catch (Exception $e) {
    echo 'Test 5 failed';
}