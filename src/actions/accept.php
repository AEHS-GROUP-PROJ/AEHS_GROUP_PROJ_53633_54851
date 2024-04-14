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

// Checking if enrollment exists

if
(
	!sql ( '
	SELECT 1 FROM `enrollments` WHERE
		`enrollments`.student_id='.$_POST['student'].' AND
		`enrollments`.course_id='.$_POST['course'], 1 )
)
{
	message ( 'The enrollment does not exist', 2 );

	route ( 'enrollments' );

	return;
}

// Updating the enrollment record

if
(
	sql ( '
	UPDATE `enrollments` SET `enrollments`.is_accepted=1 WHERE
		`enrollments`.student_id='.$_POST['student'].' AND
		`enrollments`.course_id='.$_POST['course'], 1 )
)
	message ( 'The student has been accepted', 1 );

route ( 'enrollments' );