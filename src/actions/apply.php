<?php

// Access check

if ( !$_USER['is_student'] )
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

// Checking if user has already applied

if
(
	sql ( '
	SELECT 1 FROM `enrollments` WHERE
		`enrollments`.student_id='.$_USER['id'].' AND
		`enrollments`.course_id='.$_POST['course'], 1 )
)
{
	message ( 'You have already applied for this course', 2 );

	route ( 'my_courses' );

	return;
}

// Checking if course has places available

if
(
	!sql ( '
	SELECT `courses`.places-COUNT(IF(`enrollments`.is_accepted, 1, NULL)) AS `places_available`
	FROM `courses`
	LEFT JOIN `enrollments` ON `enrollments`.course_id=`courses`.id
	WHERE
		`courses`.id='.$_POST['course'].' AND
		`courses`.start_date>\''.date ( 'Y-m-d' ).'\'
	GROUP BY `courses`.id
	HAVING `places_available`>0', 1 )
)
{
	message ( 'Sorry, the course is not available', 2 );

	route ( 'my_courses' );

	return;
}

// Creating an enrollment record

if
(
	!sql ( '
	INSERT INTO `enrollments`
	(
		`enrollments`.student_id,
		`enrollments`.course_id
	)
	VALUES
	(
		'.$_USER['id'].',
		'.$_POST['course'].'
	)', 1 )
)
{
	message ( 'Failed to create an enrollment', 3 );

	return;
}

message ( 'You have successfully applied for the course', 1 );

route ( 'my_courses' );