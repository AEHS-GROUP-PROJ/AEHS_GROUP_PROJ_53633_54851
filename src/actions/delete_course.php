<?php

// Access check

if ( !$_USER['is_admin'] )
{
	message ( 'Access denied', 3 );

	return;
}

// Input checks

if ( !isset ( $_POST['course'] ) || !str_fit ( '[1-9]\d{0,15}', $_POST['course'] ) )
{
	message ( 'Payload missing', 3 );

	return;
}

// Deleting the course record

if ( sql ( 'DELETE FROM `courses` WHERE `courses`.id='.$_POST['course'], 1 ) )
	message ( 'Course successfully deleted', 1 );

route ( 'course_management' );