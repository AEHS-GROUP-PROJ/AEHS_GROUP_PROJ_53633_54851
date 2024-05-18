<?php

// Access check

if ( !$_USER['is_admin'] && !$_USER['is_lecturer'])
{
	message ( 'Access denied', 3 );

	return;
}

// Input checks

if ( !isset ( $_POST['title'] ) || !isset ( $_POST['text'] ) )
{
	message ( 'Payload missing', 3 );

	return;
}

if ( !str_len ( $_POST['title'] = str_wash ( $_POST['title'] ) ) )
{
	message ( 'Please provide a title', 2 );

	return;
}

if ( !str_len ( $_POST['text'] = str_wash ( $_POST['text'], 'multiline' ) ) )
{
	message ( 'Please provide announcement text', 2 );

	return;
}

// Creating an announcement record

if
(
	!sql ( '
	INSERT INTO `announcements`
	(
		`announcements`.user_id,
		`announcements`.submitted_at,
		`announcements`.title,
		`announcements`.text
	)
	VALUES
	(
		'.$_USER['id'].',
		NOW(),
		'.sql_escape ( $_POST['title'], 50 ).',
		'.sql_escape ( $_POST['text'], 1000 ).'
	)', 1 )
)
{
	message ( 'Failed to make an announcement', 3 );

	return;
}

message ( 'Announcement succesfully added', 1 );

route ( 'announcements' );