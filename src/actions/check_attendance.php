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
	!isset ( $_POST['lecture']  ) || !str_fit ( '[1-9]\d{0,15}', $_POST['lecture']  ) ||
	!isset ( $_POST['student'] ) || !str_fit ( '[1-9]\d{0,15}', $_POST['student'] ) ||
	!isset ( $_POST['attendance']  ) || !str_fit ( '(0|1)', $_POST['attendance'] )
)
{
	message ( 'Payload missing', 3 );

	return;
}

// Checking if current user is the actual lecturer

if
(
	!sql ( '
	SELECT 1 FROM `lectures` WHERE
		`lectures`.id='.$_POST['lecture'].' AND
		`lectures`.lecturer_id='.$_USER['id'], 1 )
)
{
	message ( 'You are not the lecturer for this course', 2 );

	route ( 'attendance' );

	return;
}

// Checking if student is enrolled in the course

if
(
	!sql ( '
	SELECT 1 FROM `enrolments`
	JOIN `courses` ON `courses`.id=`enrolments`.course_id
	JOIN `lectures` ON `lectures`.course_id=`courses`.id
	WHERE
		`enrolments`.student_id='.$_POST['student'].' AND
		`lectures`.id='.$_POST['lecture'], 1 )
)
{
	message ( 'The student is not enrolled in the course', 2 );

	route ( 'attendance' );

	return;
}

// Marking student as present

if
(
	$_POST['attendance'] &&
	sql ( '
	REPLACE INTO `attendance`
	(
		`attendance`.lecture_id,
		`attendance`.student_id
	)
	VALUES
	(
		'.$_POST['lecture'].',
		'.$_POST['student'].'
	)', 1 )
)
	message ( 'Attendance updated', 1 );

// Marking student as absent

if
(
	!$_POST['attendance'] &&
	sql ( '
	DELETE FROM `attendance` WHERE
		`attendance`.lecture_id='.$_POST['lecture'].' AND
		`attendance`.student_id='.$_POST['student'], 1 )
)
	message ( 'Attendance updated', 1 );

route ( 'attendance' );