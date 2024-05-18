<?php

// Input checks

if
(
	!isset ( $_POST['assignment'] ) || !str_fit ( '[1-9]\d{0,15}', $_POST['assignment'] ) ||
	!isset ( $_POST['text'] )
)
{
	message ( 'Payload missing', 3 );

	return;
}

/*

Check if:

	1. Assignment exists
	2. Assignment belongs to a course current user is enrolled in
	3. Assignment was already submitted

*/

if
(
	!$ASSIGNMENT = sql ( '
	SELECT
		`assignments`.id,
		`assignments`.deadline,
		`assignment_submissions`.student_id IS NOT NULL AS `submitted`,
		`assignment_submissions`.text
	FROM `assignments`
	JOIN `courses` ON `courses`.id=`assignments`.course_id
	JOIN `enrolments` ON
		`enrolments`.student_id='.$_USER['id'].' AND
		`enrolments`.course_id=`courses`.id
	LEFT JOIN `assignment_submissions` ON
		`assignment_submissions`.assignment_id=`assignments`.id AND
		`assignment_submissions`.student_id='.$_USER['id'].'
	WHERE `assignments`.id='.sql_escape ( $_POST['assignment'], 16 ), 1 )
)
{
	message ( 'Assignment not found', 3 );

	route ( 'my_assignments' );

	return;
}

// Check if the assignment's deadline has passed

if ( $ASSIGNMENT['deadline'] < date ( 'Y-m-d H:i:s' ) )
{
	message ( 'The deadline has passed', 2 );

	route ( 'my_assignments' );

	return;
}

// Check if any content was provided

if ( !str_len ( $_POST['text'] = str_wash ( $_POST['text'], 'multiline' ) ) )
{
	message ( 'Please provide some content', 2 );

	return;
}

// Updating already submitted assignment, removing the grade (if text was changed)

if
(
	$ASSIGNMENT['submitted'] &&
	$ASSIGNMENT['text'] !== $_POST['text'] &&
	sql ( '
	UPDATE `assignment_submissions` SET
		`assignment_submissions`.submitted_at=NOW(),
		`assignment_submissions`.text='.sql_escape ( $_POST['text'], 10000 ).',
		`assignment_submissions`.grade=NULL
	WHERE
		`assignment_submissions`.assignment_id='.$ASSIGNMENT['id'].' AND
		`assignment_submissions`.student_id='.$_USER['id'], 1 )
)
	message ( 'Assignment submission updated', 1 );

// Creating a new assignment submission record

if
(
	!$ASSIGNMENT['submitted'] &&
	sql ( '
	INSERT INTO `assignment_submissions`
	(
		`assignment_submissions`.assignment_id,
		`assignment_submissions`.student_id,
		`assignment_submissions`.submitted_at,
		`assignment_submissions`.text
	)
	VALUES
	(
		'.$ASSIGNMENT['id'].',
		'.$_USER['id'].',
		NOW(),
		'.sql_escape ( $_POST['text'], 10000 ).'
	)', 1 )
)
	message ( 'Assignment succesfully submitted', 1 );

route ( 'my_assignments' );