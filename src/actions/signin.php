<?php

// Checking inputs

if ( !isset ( $_POST['email'] ) || !isset ( $_POST['password'] ) )
{
	message ( 'Payload missing', 3 );

	return;
}

// Checking password validity

if
(
	!$USER = sql ( '
	SELECT `users`.id FROM `users` WHERE
		`users`.email='.sql_escape ( $_POST['email'], 50 ).' AND
		`users`.password_hash='.sql_escape ( hash ( 'sha256', $_POST['password'] ), 64 ), 1 )
)
{
	message ( 'Password is invalid', 2 );

	return;
}

// Sign in successful, initializing a session

$token = str_rand ( 16 );

if
(
	!sql ( '
	INSERT INTO `sessions`
	(
		`sessions`.token,
		`sessions`.user_id,
		`sessions`.host,
		`sessions`.agent
	)
	VALUES
	(
		'.sql_escape ( $token, 16 ).',
		'.$USER['id'].',
		'.sql_escape ( $_SERVER['REMOTE_ADDR'], 100 ).',
		'.sql_escape ( $_SERVER['HTTP_USER_AGENT'], 100 ).'
	)', 1 )
)
{
	message ( 'Failed to create a session', 3 );

	return;
}

setcookie ( 'sis_token', $token, time () + 72000 );

message ( 'You are now signed in', 1 );

route ( 'my_courses' );