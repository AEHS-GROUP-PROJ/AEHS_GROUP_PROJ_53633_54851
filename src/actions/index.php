<?php

if ( !isset ( $_POST['action'] ) )
	exit ( '{}' );

$JSON = [];

// This is some sort of a router but for actions

if ( $_POST['action'] === 'signin' )
	require 'signin.php';
elseif ( $_POST['action'] === 'signout' )
	require 'signout.php';
elseif ( !$_USER )
	message ( 'Access denied', 3 );
elseif ( $_POST['action'] === 'accept' )
	require 'accept.php';
elseif ( $_POST['action'] === 'apply' )
	require 'apply.php';
elseif ( $_POST['action'] === 'check_attendance' )
	require 'check_attendance.php';
elseif ( $_POST['action'] === 'create_announcement' )
	require 'create_announcement.php';
elseif ( $_POST['action'] === 'create_assignment' )
	require 'create_assignment.php';
elseif ( $_POST['action'] === 'create_classroom' )
	require 'create_classroom.php';
elseif ( $_POST['action'] === 'create_course' )
	require 'create_course.php';
elseif ( $_POST['action'] === 'create_lecture' )
	require 'create_lecture.php';
elseif ( $_POST['action'] === 'create_user' )
	require 'create_user.php';
elseif ( $_POST['action'] === 'delete_announcement' )
	require 'delete_announcement.php';
elseif ( $_POST['action'] === 'delete_classroom' )
	require 'delete_classroom.php';
elseif ( $_POST['action'] === 'delete_course' )
	require 'delete_course.php';
elseif ( $_POST['action'] === 'delete_lecture' )
	require 'delete_lecture.php';
elseif ( $_POST['action'] === 'delete_user' )
	require 'delete_user.php';
elseif ( $_POST['action'] === 'dropout' )
	require 'dropout.php';
elseif ( $_POST['action'] === 'edit_announcement' )
	require 'edit_announcement.php';
elseif ( $_POST['action'] === 'edit_assignment' )
	require 'edit_assignment.php';
elseif ( $_POST['action'] === 'edit_classroom' )
	require 'edit_classroom.php';
elseif ( $_POST['action'] === 'edit_course' )
	require 'edit_course.php';
elseif ( $_POST['action'] === 'edit_lecture' )
	require 'edit_lecture.php';
elseif ( $_POST['action'] === 'edit_user' )
	require 'edit_user.php';
elseif ( $_POST['action'] === 'grade' )
	require 'grade.php';
elseif ( $_POST['action'] === 'submit_assignment' )
	require 'submit_assignment.php';
elseif ( $_POST['action'] === 'withdraw' )
	require 'withdraw.php';

exit ( str_json ( $JSON ) );