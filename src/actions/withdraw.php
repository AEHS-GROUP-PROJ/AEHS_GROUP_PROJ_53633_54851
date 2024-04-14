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

// Deleting the enrollment record

if
(
	sql ( '
	DELETE FROM `enrollments` WHERE
		`enrollments`.student_id='.$_USER['id'].' AND
		`enrollments`.course_id='.$_POST['course'], 1 )
)
	message ( 'You have successfully withdrawn from the course', 1 );

route ( 'my_courses' );