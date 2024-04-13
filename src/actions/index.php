<?php

if ( !isset ( $_POST['action'] ) )
	exit ( '{}' );

$JSON = [];

if ( $_POST['action'] === 'login' )
	require 'login.php';
elseif ( $_POST['action'] === 'create_user' )
	require 'create_user.php';

exit ( str_json ( $JSON ) );