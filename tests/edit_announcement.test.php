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
    if (strpos($query, 'SELECT 1 FROM `announcements`') !== false) {
        return true; // Assume announcement exists for testing
    }
    return true;
}

function sql_escape($str, $length) {
    return $str;
}

function route($route) {
    throw new Exception('Routed to ' . $route);
}

// Test case 1: Access denied for non-admin and non-lecturer
$_USER = ['is_admin' => false, 'is_lecturer' => false];
try {
    include 'edit_announcement.php';
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
    include 'edit_announcement.php';
    echo 'Test 2 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Payload missing') {
        echo 'Test 2 passed';
    } else {
        echo 'Test 2 failed';
    }
}

// Test case 3: Announcement does not exist
$_USER = ['is_admin' => true];
$_POST = ['announcement' => '1234567890123456', 'title' => 'Test Title', 'text' => 'Test Text'];
function sql($query, $type) {
    if (strpos($query, 'SELECT 1 FROM `announcements`') !== false) {
        return false; // Assume announcement does not exist for testing
    }
    return true;
}
try {
    include 'edit_announcement.php';
    echo 'Test 3 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Announcement does not exist') {
        echo 'Test 3 passed';
    } else {
        echo 'Test 3 failed';
    }
}

// Test case 4: Announcement successfully updated
$_USER = ['is_admin' => true, 'id' => '1234567890123456'];
$_POST = ['announcement' => '1234567890123456', 'title' => 'Test Title', 'text' => 'Test Text'];
function sql($query, $type) {
    if (strpos($query, 'SELECT 1 FROM `announcements`') !== false) {
        return true; // Assume announcement exists for testing
    }
    return true;
}
try {
    include 'edit_announcement.php';
    echo 'Test 4 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Course successfully updated') {
        echo 'Test 4 passed';
    } else {
        echo 'Test 4 failed';
    }
}