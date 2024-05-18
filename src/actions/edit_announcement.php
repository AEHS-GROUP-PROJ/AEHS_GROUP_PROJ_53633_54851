<?php

// Access check

if ( !$_USER['is_admin'] && !$_USER['is_lecturer'] )
{
	message ( 'Access denied', 3 );

	return;
}

// Input checks

if
(
	!isset ( $_POST['announcement'] ) || !str_fit ( '[1-9]\d{0,15}', $_POST['announcement'] ) ||
	!isset ( $_POST['title'] ) ||
	!isset ( $_POST['text'] )
)
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

// Checking if announcement exists

if ( !sql ( 'SELECT 1 FROM `announcements` WHERE `announcements`.id='.$_POST['announcement'], 1 ) )
{
	message ( 'Announcement does not exist', 3 );

	route ( 'announcements' );

	return;
}

// Updating the announcement record

if
(
	sql ( '
	UPDATE `announcements` SET
		`announcements`.title='.sql_escape ( $_POST['title'], 50 ).',
		`announcements`.text='.sql_escape ( $_POST['text'], 1000 ).'
	WHERE `announcements`.id='.$_POST['announcement'], 1 )
)
{
	// Title/text updated, so we have to refresh author/timestamp

	sql ( '
	UPDATE `announcements` SET
		`announcements`.user_id='.$_USER['id'].',
		`announcements`.submitted_at=NOW()
	WHERE `announcements`.id='.$_POST['announcement'], 1 );

	message ( 'Course successfully updated', 1 );
}

route ( 'announcements' );