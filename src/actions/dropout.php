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
	!isset ( $_POST['student'] ) || !str_fit ( '[1-9]\d{0,15}', $_POST['student'] ) ||
	!isset ( $_POST['course']  ) || !str_fit ( '[1-9]\d{0,15}', $_POST['course']  )
)
{
	message ( 'Payload missing', 3 );

	return;
}

// Checking if enrolment exists

if
(
	!sql ( '
	SELECT 1 FROM `enrolments` WHERE
		`enrolments`.student_id='.$_POST['student'].' AND
		`enrolments`.course_id='.$_POST['course'], 1 )
)
{
	message ( 'The enrolment does not exist', 2 );

	route ( 'enrolments' );

	return;
}

// Updating the enrolment record

if
(
	sql ( '
	UPDATE `enrolments` SET `enrolments`.is_accepted=0 WHERE
		`enrolments`.student_id='.$_POST['student'].' AND
		`enrolments`.course_id='.$_POST['course'], 1 )
)
	message ( 'The student has been dropped out', 1 );

route ( 'enrolments' );