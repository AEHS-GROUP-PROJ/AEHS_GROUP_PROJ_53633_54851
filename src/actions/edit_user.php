<?php

// Access check

if ( !$_USER['is_admin'] )
{
	message ( 'Access denied', 3 );

	return;
}

// Input checks

if
(
	!isset ( $_POST['user'] ) || !str_fit ( '[1-9]\d{0,15}', $_POST['user'] ) ||
	!isset ( $_POST['email'] ) ||
	!isset ( $_POST['full_name'] ) ||
	!isset ( $_POST['address'] ) ||
	!isset ( $_POST['phone'] ) ||
	!isset ( $_POST['is_student'] ) ||
	!isset ( $_POST['is_lecturer'] ) ||
	!isset ( $_POST['is_admin'] ) ||
	!isset ( $_POST['password'] ) ||
	!isset ( $_POST['password_confirm'] )
)
{
	message ( 'Payload missing', 3 );

	return;
}

if
(
	str_len ( $_POST['email'] ) > 50 ||
	!filter_var ( $_POST['email'] = str_wash ( $_POST['email'] ), FILTER_VALIDATE_EMAIL )
)
{
	message ( 'Please provide a valid email address', 2 );

	return;
}

if ( !str_len ( $_POST['full_name'] = str_wash ( $_POST['full_name'] ) ) )
{
	message ( 'Please provide user\'s full name', 2 );

	return;
}

if ( $_POST['user'] === $_USER['id'] && !$_POST['is_admin'] )
{
	message ( 'You cannot self-unassign admin privileges', 2 );

	return;
}

if ( str_len ( $_POST['password'] ) )
{
	if ( str_len ( $_POST['password'] ) < 8 )
	{
		message ( 'Please provide a password at least 8 characters long', 2 );

		return;
	}

	if ( $_POST['password'] !== $_POST['password_confirm'] )
	{
		message ( 'Password fields do not match', 2 );

		return;
	}
}

// Checking if user already exists

if
(
	sql ( '
	SELECT 1 FROM `users` WHERE
		`users`.id<>'.$_POST['user'].' AND
		`users`.email='.sql_escape ( $_POST['email'], 50 ), 1 )
)
{
	message ( 'User with such email already exists', 2 );

	return;
}

// Updating the user record

if
(
	sql ( '
	UPDATE `users` SET
		`users`.email='.sql_escape ( $_POST['email'], 50 ).',
		`users`.full_name='.sql_escape ( $_POST['full_name'], 50 ).',
		`users`.address='.sql_escape ( str_wash ( $_POST['address'] ), 50 ).',
		`users`.phone='.sql_escape ( str_wash ( $_POST['phone'] ), 50 ).',
		`users`.is_student='.( $_POST['is_student'] ? 1 : 0).',
		`users`.is_lecturer='.( $_POST['is_lecturer'] ? 1 : 0).',
		`users`.is_admin='.( $_POST['is_admin'] ? 1 : 0).',
		`users`.password_hash='.( str_len ( $_POST['password'] ) ? sql_escape ( hash ( 'sha256', $_POST['password'] ), 64 ) : '`users`.password_hash' ).'
	WHERE `users`.id='.$_POST['user'], 1 )
)
	message ( 'User successfully updated', 1 );

route ( 'user_management' );