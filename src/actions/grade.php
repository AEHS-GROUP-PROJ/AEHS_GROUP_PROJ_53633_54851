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
	!isset ( $_POST['assignment']  ) || !str_fit ( '[1-9]\d{0,15}', $_POST['assignment'] ) ||
	!isset ( $_POST['student'] ) || !str_fit ( '[1-9]\d{0,15}', $_POST['student'] ) ||
	!isset ( $_POST['grade'] ) || !str_fit ( '(\d|10)', $_POST['grade'] )
)
{
	message ( 'Payload missing', 3 );

	return;
}

// Checking if assignment submission exists

if
(
	!sql ( '
	SELECT 1 FROM `assignment_submissions` WHERE
		`assignment_submissions`.assignment_id='.$_POST['assignment'].' AND
		`assignment_submissions`.student_id='.$_POST['student'], 1 )
)
{
	message ( 'The assignment submission does not exist', 2 );

	route ( 'grading_'.$_POST['assignment'] );

	return;
}

// Updating the grade value

if
(
	sql ( '
	UPDATE `assignment_submissions`
	SET `assignment_submissions`.grade='.( $_POST['grade'] ? $_POST['grade'] : 'NULL' ).'
	WHERE
		`assignment_submissions`.assignment_id='.$_POST['assignment'].' AND
		`assignment_submissions`.student_id='.$_POST['student'], 1 )
)
	message ( 'Grade has been updated', 1 );

route ( 'grading_'.$_POST['assignment'] );