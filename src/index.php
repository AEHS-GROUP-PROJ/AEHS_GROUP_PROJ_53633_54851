<?php

if
(
	!mb_internal_encoding ( 'UTF-8' ) ||
	!mb_regex_encoding ( 'UTF-8' ) ||
	mb_regex_set_options ( 'pr' ) !== 'pr'
)
	exit ( 'Unable to initialise Unicode' );

require 'lib/database.php';
require 'lib/functions.php';

// Checking if user is authorized

if
(
	!isset ( $_COOKIE['sis_token'] ) ||
	!str_fit ( '[a-z\d]{16}', $_COOKIE['sis_token'] ) ||
	!$_USER = sql ( '
	SELECT
		`users`.id,
		`users`.email,
		`users`.full_name,
		`users`.address,
		`users`.phone,
		`users`.is_student,
		`users`.is_lecturer,
		`users`.is_admin,
		`sessions`.token
	FROM `users`
	JOIN `sessions` ON `sessions`.user_id=`users`.id
	WHERE `sessions`.token='.sql_escape ( $_COOKIE['sis_token'], 16 ), 1 )
)
	$_USER = NULL;

if ( $_SERVER['REQUEST_METHOD'] === 'GET' )
{
	if ( !$_USER )
		$_GET['route'] = 'signin';
	elseif ( !isset ( $_GET['route'] ) )
		$_GET['route'] = NULL;

	ob_start();

	// Routing to the requested page

	if ( $_GET['route'] === 'create_user' )
		require 'routes/create_user.html';
	elseif ( str_fit ( 'edit_user_[1-9]\d{0,15}', $_GET['route'] ) )
		require 'routes/edit_user.html';
	elseif ( $_GET['route'] === 'signin' )
		require 'routes/signin.html';
	elseif ( $_GET['route'] === 'user_management' )
		require 'routes/user_management.html';
	else
		require 'routes/home.html';

	$CONTENT = ob_get_clean();
}
if ( $_SERVER['REQUEST_METHOD'] === 'POST' )
	require 'actions/index.php';

require 'static/layout.html';