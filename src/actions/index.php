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
elseif ( $_POST['action'] === 'create_course' )
	require 'create_course.php';
elseif ( $_POST['action'] === 'create_user' )
	require 'create_user.php';
elseif ( $_POST['action'] === 'delete_course' )
	require 'delete_course.php';
elseif ( $_POST['action'] === 'delete_user' )
	require 'delete_user.php';
elseif ( $_POST['action'] === 'dropout' )
	require 'dropout.php';
elseif ( $_POST['action'] === 'edit_course' )
	require 'edit_course.php';
elseif ( $_POST['action'] === 'edit_user' )
	require 'edit_user.php';
elseif ( $_POST['action'] === 'withdraw' )
	require 'withdraw.php';

exit ( str_json ( $JSON ) );