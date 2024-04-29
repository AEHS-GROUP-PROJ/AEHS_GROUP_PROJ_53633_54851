<?php

// Access check

if ( !$_USER['is_admin'] )
{
	message ( 'Access denied', 3 );

	return;
}

// Input checks

if ( !isset ( $_POST['title'] ) || !isset ( $_POST['location'] ) )
{
	message ( 'Payload missing', 3 );

	return;
}

if ( !str_len ( $_POST['title'] = str_wash ( $_POST['title'] ) ) )
{
	message ( 'Please provide classroom\'s title', 2 );

	return;
}

if ( !str_len ( $_POST['location'] = str_wash ( $_POST['location'] ) ) )
{
	message ( 'Please provide classroom\'s location', 2 );

	return;
}

// Checking if classroom already exists

if ( sql ( 'SELECT 1 FROM `classrooms` WHERE `classrooms`.title='.sql_escape ( $_POST['title'], 50 ), 1 ) )
{
	message ( 'Classroom with such title already exists', 2 );

	return;
}

// Creating a user record

if
(
	!sql ( '
	INSERT INTO `classrooms`
	(
		`classrooms`.title,
		`classrooms`.location
	)
	VALUES
	(
		'.sql_escape ( $_POST['title'], 50 ).',
		'.sql_escape ( $_POST['location'], 50 ).'
	)', 1 )
)
{
	message ( 'Failed to create a classroom', 3 );

	return;
}

message ( 'Classroom successfully created', 1 );

route ( 'classrooms' );