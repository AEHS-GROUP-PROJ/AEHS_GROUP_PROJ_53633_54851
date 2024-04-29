<?php

// Access check

if ( !$_USER['is_admin'] && !$_USER['is_lecturer'] )
{
	message ( 'Access denied', 3 );

	return;
}

// Input checks

if ( !isset ( $_POST['lecture'] ) || !str_fit ( '[1-9]\d{0,15}', $_POST['lecture'] ) )
{
	message ( 'Payload missing', 3 );

	return;
}

// Check if lecture was attended

if ( sql ( 'SELECT 1 FROM `attendance` WHERE `attendance`.lecture_id='.$_POST['lecture'], 1 ) )
{
	message ( 'Can\'t cancel a lecture with attendance records', 2 );

	return;
}

// Deleting the lecture record

if ( sql ( 'DELETE FROM `lectures` WHERE `lectures`.id='.$_POST['lecture'], 1 ) )
	message ( 'Lecture successfully canceled', 1 );

route ( 'lecture_schedule' );