<?php

// Invalidating session

if ( isset ( $_COOKIE['sis_token'] ) && str_fit ( '[a-z\d]{16}', $_COOKIE['sis_token'] ) )
{
	sql ( 'DELETE FROM  `sessions` WHERE `sessions`.token='.sql_escape ( $_COOKIE['sis_token'], 16 ), 1 );

	setcookie ( 'sis_token', '', time () );
}

message ( 'You are now signed out', 1 );

route ( 'signin' );