<?php

if ( !isset ( $_POST['action'] ) )
	exit ( '{}' );

$JSON = [];

if ( $_POST['action'] === 'login' )
	require 'login.php';
elseif ( $_POST['action'] === 'register' )
	require 'register.php';

exit ( str_json ( $JSON ) );