<?php

// Access check

if ( !$_USER['is_admin'] )
{
	message ( 'Access denied', 3 );

	return;
}

// Input checks

if ( !isset ( $_POST['user'] ) || !str_fit ( '[1-9]\d{0,15}', $_POST['user'] ) )
{
	message ( 'Payload missing', 3 );

	return;
}

if ( $_POST['user'] === $_USER['id'] )
{
	message ( 'You cannot delete yourself', 2 );

	return;
}

// Deleting the user record

if ( sql ( 'DELETE FROM `users` WHERE `users`.id='.$_POST['user'], 1 ) )
	message ( 'User successfully deleted', 1 );

route ( 'user_management' );