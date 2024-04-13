<?php

if
(
	!isset ( $_POST['full_name'] ) ||
	!str_len ( $_POST['full_name'] = str_wash ( $_POST['full_name'] ) )
)
{
	message ( 'Please provide user\'s full name', 2 );

	return;
}

if
(
	!isset ( $_POST['email'] ) ||
	!filter_var ( $_POST['email'] = str_wash ( $_POST['email'] ), FILTER_VALIDATE_EMAIL )
)
{
	message ( 'Please provide a valid email address', 2 );

	return;
}



message ('creating user');


//go ( '?route=register' );