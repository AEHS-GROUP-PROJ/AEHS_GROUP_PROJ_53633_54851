<?php

// Access check

if ( !$_USER['is_admin'] )
{
	message ( 'Access denied', 3 );

	return;
}

// Input checks

if ( !isset ( $_POST['classroom'] ) || !str_fit ( '[1-9]\d{0,15}', $_POST['classroom'] ) )
{
	message ( 'Payload missing', 3 );

	return;
}

// Deleting the classroom record

if ( sql ( 'DELETE FROM `classrooms` WHERE `classrooms`.id='.$_POST['classroom'], 1 ) )
	message ( 'Classroom successfully deleted', 1 );

route ( 'classrooms' );