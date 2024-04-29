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
	!isset ( $_POST['lecture'] ) || !str_fit ( '[1-9]\d{0,15}', $_POST['lecture'] ) ||
	!isset ( $_POST['title'] ) ||
	!isset ( $_POST['starts_at'] ) ||
	!isset ( $_POST['course'] ) ||
	!isset ( $_POST['lecturer'] ) ||
	!isset ( $_POST['location'] )
)
{
	message ( 'Payload missing', 3 );

	return;
}

if ( !str_len ( $_POST['title'] = str_wash ( $_POST['title'] ) ) )
{
	message ( 'Please provide lecture\'s title', 2 );

	return;
}

if ( !str_fit ( '\d{4}-\d{2}-\d{2}T\d{2}:\d{2}', $_POST['starts_at'], 'cs' ) )
{
	message ( 'Please provide lecture\'s start date and time', 2 );

	return;
}

if ( $_POST['starts_at'] < date ( 'Y-m-d\TH:i', strtotime ( '00:00 +1 day' ) ) )
{
	message ( 'Updated lecture can\'t start earlier than tomorrow', 2 );

	return;
}

if
(
	!str_fit ( '[1-9]\d{0,15}', $_POST['course'] ) ||
	!sql ( 'SELECT 1 FROM `courses` WHERE `courses`.id='.$_POST['course'], 1 )
)
{
	message ( 'Please select an existing course', 2 );

	return;
}

// Check if this course already has a lecture at this time

if
(
	sql ( '
	SELECT 1 FROM `lectures` WHERE
		`lectures`.id<>'.$_POST['lecture'].' AND
		`lectures`.course_id='.$_POST['course'].' AND
		`lectures`.starts_at>\''.date ( 'Y-m-d\TH:i', strtotime ( $_POST['starts_at'].' -90 minute' ) ).'\' AND
		`lectures`.starts_at<\''.date ( 'Y-m-d\TH:i', strtotime ( $_POST['starts_at'].' +90 minute' ) ).'\'
	LIMIT 1', 1 )
)
{
	message ( 'This course already has a lecture scheduled for selected time', 2 );

	return;
}

if
(
	!str_fit ( '[1-9]\d{0,15}', $_POST['lecturer'] ) ||
	!sql ( 'SELECT 1 FROM `users` WHERE `users`.id='.$_POST['lecturer'].' AND `users`.is_lecturer<>0', 1 )
)
{
	message ( 'Please select an existing lecturer', 2 );

	return;
}

// Check if this lecturer already has a lecture at this time

if
(
	sql ( '
	SELECT 1 FROM `lectures` WHERE
		`lectures`.id<>'.$_POST['lecture'].' AND
		`lectures`.lecturer_id='.$_POST['lecturer'].' AND
		`lectures`.starts_at>\''.date ( 'Y-m-d\TH:i', strtotime ( $_POST['starts_at'].' -90 minute' ) ).'\' AND
		`lectures`.starts_at<\''.date ( 'Y-m-d\TH:i', strtotime ( $_POST['starts_at'].' +90 minute' ) ).'\'
	LIMIT 1', 1 )
)
{
	message ( 'This lecturer already has a lecture scheduled for selected time', 2 );

	return;
}

if
(
	!str_fit ( '[1-9]\d{0,15}', $_POST['location'] ) ||
	!sql ( 'SELECT 1 FROM `classrooms` WHERE `classrooms`.id='.$_POST['location'], 1 )
)
{
	message ( 'Please select an existing classroom', 2 );

	return;
}

// Check if this classroom already has a lecture at this time

if
(
	sql ( '
	SELECT 1 FROM `lectures` WHERE
		`lectures`.id<>'.$_POST['lecture'].' AND
		`lectures`.classroom_id='.$_POST['location'].' AND
		`lectures`.starts_at>\''.date ( 'Y-m-d\TH:i', strtotime ( $_POST['starts_at'].' -90 minute' ) ).'\' AND
		`lectures`.starts_at<\''.date ( 'Y-m-d\TH:i', strtotime ( $_POST['starts_at'].' +90 minute' ) ).'\'
	LIMIT 1', 1 )
)
{
	message ( 'This classroom already has a lecture scheduled for selected time', 2 );

	return;
}

// Updating the lecture record

if
(
	sql ( '
	UPDATE `lectures` SET
		`lectures`.course_id='.$_POST['course'].',
		`lectures`.lecturer_id='.$_POST['lecturer'].',
		`lectures`.classroom_id='.$_POST['location'].',
		`lectures`.title='.sql_escape ( $_POST['title'], 50 ).',
		`lectures`.starts_at=\''.date ( 'Y-m-d H:i:s', strtotime ( $_POST['starts_at'] ) ).'\'
	WHERE `lectures`.id='.$_POST['lecture'], 1 )
)
	message ( 'Schedule successfully updated', 1 );

route ( 'lecture_schedule' );