<?php

if ( !isset ( $_POST['action'] ) )
	exit ( '{}' );

$JSON = [];

if ( $_POST['action'] === 'signin' )
	require 'signin.php';
elseif ( $_POST['action'] === 'signout' )
	require 'signout.php';
elseif ( !$_USER )
	message ( 'Access denied', 3 );
elseif ( $_POST['action'] === 'create_user' )
	require 'create_user.php';
elseif ( $_POST['action'] === 'delete_user' )
	require 'delete_user.php';
elseif ( $_POST['action'] === 'edit_user' )
	require 'edit_user.php';

exit ( str_json ( $JSON ) );