<?php
// Mocking functions
function message($message, $type) {
    throw new Exception($message);
}

function str_fit($pattern, $str, $type) {
    return preg_match("/$pattern/", $str);
}

// Test case 1: Invalid deadline format
$_POST['deadline'] = 'invalid format';
try {
    include 'create_assignment.php';
    echo 'Test 1 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Please provide assignment\'s deadline') {
        echo 'Test 1 passed';
    } else {
        echo 'Test 1 failed';
    }
}

// Test case 2: Deadline earlier than tomorrow
$_POST['deadline'] = date('Y-m-d\TH:i', strtotime('00:00'));
try {
    include 'create_assignment.php';
    echo 'Test 2 failed';
} catch (Exception $e) {
    if ($e->getMessage() === 'Deadline can\'t be earlier than tomorrow') {
        echo 'Test 2 passed';
    } else {
        echo 'Test 2 failed';
    }
}

// Test case 3: Valid deadline
$_POST['deadline'] = date('Y-m-d\TH:i', strtotime('00:00 +2 day'));
try {
    include 'create_assignment.php';
    echo 'Test 3 passed';
} catch (Exception $e) {
    echo 'Test 3 failed';
}