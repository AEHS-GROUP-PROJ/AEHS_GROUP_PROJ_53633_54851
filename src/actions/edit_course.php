<?php

// Access check

if ( !$_USER['is_admin'] )
{
	message ( 'Access denied', 3 );

	return;
}

// Input checks

if
(
	!isset ( $_POST['course'] ) || !str_fit ( '[1-9]\d{0,15}', $_POST['course'] ) ||
	!isset ( $_POST['title'] ) ||
	!isset ( $_POST['start_date'] ) ||
	!isset ( $_POST['end_date'] ) ||
	!isset ( $_POST['places'] )
)
{
	message ( 'Payload missing', 3 );

	return;
}

if ( !str_len ( $_POST['title'] = str_wash ( $_POST['title'] ) ) )
{
	message ( 'Please provide a course title', 2 );

	return;
}

if ( !str_fit ( '\d{4}\-\d{2}\-\d{2}', $_POST['start_date'] ) )
{
	message ( 'Please provide a start date', 2 );

	return;
}

if ( !$COURSE = sql ( 'SELECT `courses`.start_date FROM `courses` WHERE `courses`.id='.$_POST['course'], 1 ) )
{
	message ( 'Course does not exist', 3 );

	route ( 'course_management' );

	return;
}

if
(
	$_POST['start_date'] < $COURSE['start_date'] &&
	$_POST['start_date'] < date ( 'Y-m-d', strtotime ( '+1 day' ) )
)
{
	message ( 'Start date can\'t be earlier than tomorrow', 2 );

	return;
}

if ( !str_fit ( '\d{4}\-\d{2}\-\d{2}', $_POST['end_date'] ) )
{
	message ( 'Please provide an end date', 2 );

	return;
}

if ( $_POST['end_date'] < $_POST['start_date'] )
{
	message ( 'End date can\'t be earlier than start date', 2 );

	return;
}

if ( !str_fit ( '\d+', $_POST['places'] ) )
{
	message ( 'Please provide the number of available places', 2 );

	return;
}

if ( intval ( $_POST['places'] ) < 1 )
{
	message ( 'Course must have at least one place available', 2 );

	return;
}

// Checking if course already exists

if
(
	sql ( '
	SELECT 1 FROM `courses` WHERE
		`courses`.id<>'.$_POST['course'].' AND
		`courses`.title='.sql_escape ( $_POST['title'], 50 ), 1 )
)
{
	message ( 'Course with such title already exists', 2 );

	return;
}

// Updating the course record

if
(
	sql ( '
	UPDATE `courses` SET
		`courses`.title='.sql_escape ( $_POST['title'], 50 ).',
		`courses`.start_date='.sql_escape ( $_POST['start_date'], 10 ).',
		`courses`.end_date='.sql_escape ( $_POST['end_date'], 10 ).',
		`courses`.places='.min ( intval ( $_POST['places'] ), 999 ).'
	WHERE `courses`.id='.$_POST['course'], 1 )
)
	message ( 'Course successfully updated', 1 );

route ( 'course_management' );