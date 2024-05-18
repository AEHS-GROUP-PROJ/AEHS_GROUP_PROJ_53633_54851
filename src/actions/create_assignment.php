<?php

// Access check

if ( !$_USER['is_lecturer'] )
{
	message ( 'Access denied', 3 );

	return;
}

// Input checks

if
(
	!isset ( $_POST['course'] ) ||
	!isset ( $_POST['title'] ) ||
	!isset ( $_POST['deadline'] )
)
{
	message ( 'Payload missing', 3 );

	return;
}

// Check if the chosen course exists and is ongoing

if
(
	!str_fit ( '[1-9]\d{0,15}', $_POST['course'] ) ||
	!sql (
	'SELECT 1 FROM `courses` WHERE
		`courses`.id='.$_POST['course'].' AND
		`courses`.end_date>NOW()', 1 )
)
{
	message ( 'Please select an ongoing course', 2 );

	return;
}

if ( !str_len ( $_POST['title'] = str_wash ( $_POST['title'] ) ) )
{
	message ( 'Please provide assignment\'s title', 2 );

	return;
}

// Check if assignment with such a name already exists in this course

if
(
	sql ( '
	SELECT 1 FROM `assignments` WHERE
		`assignments`.course_id='.$_POST['course'].' AND
		`assignments`.title='.sql_escape ( $_POST['title'], 50 ).'
	LIMIT 1', 1 )
)
{
	message ( 'Assignment already exists', 2 );

	return;
}

if ( !str_fit ( '\d{4}-\d{2}-\d{2}T\d{2}:\d{2}', $_POST['deadline'], 'cs' ) )
{
	message ( 'Please provide assignment\'s deadline', 2 );

	return;
}

// Check if deadline is reasonable

if ( $_POST['deadline'] < date ( 'Y-m-d\TH:i', strtotime ( '00:00 +1 day' ) ) )
{
	message ( 'Deadline can\'t be earlier than tomorrow', 2 );

	return;
}

// Creating an assignment record

if
(
	!sql ( '
	INSERT INTO `assignments`
	(
		`assignments`.course_id,
		`assignments`.title,
		`assignments`.deadline
	)
	VALUES
	(
		'.$_POST['course'].',
		'.sql_escape ( $_POST['title'], 50 ).',
		\''.date ( 'Y-m-d H:i:s', strtotime ( $_POST['deadline'] ) ).'\'
	)', 1 )
)
{
	message ( 'Failed to create an assignment', 3 );

	return;
}

message ( 'Assignment successfully created', 1 );

route ( 'assignments' );