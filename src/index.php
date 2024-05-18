<?php

date_default_timezone_set ('Europe/Warsaw');

if
(
	!mb_internal_encoding ( 'UTF-8' ) ||
	!mb_regex_encoding ( 'UTF-8' ) ||
	mb_regex_set_options ( 'pr' ) !== 'pr'
)
	exit ( 'Unable to initialise Unicode' );

require 'lib/database.php';
require 'lib/functions.php';

// Checking if user is authorized

if
(
	!isset ( $_COOKIE['sis_token'] ) ||
	!str_fit ( '[a-z\d]{16}', $_COOKIE['sis_token'] ) ||
	!$_USER = sql ( '
	SELECT
		`users`.id,
		`users`.email,
		`users`.full_name,
		`users`.address,
		`users`.phone,
		`users`.is_student,
		`users`.is_lecturer,
		`users`.is_admin,
		`sessions`.token
	FROM `users`
	JOIN `sessions` ON `sessions`.user_id=`users`.id
	WHERE `sessions`.token='.sql_escape ( $_COOKIE['sis_token'], 16 ), 1 )
)
	$_USER = NULL;

if ( $_SERVER['REQUEST_METHOD'] === 'GET' )
{
	if ( !$_USER )
		$_GET['route'] = 'signin';
	elseif ( !isset ( $_GET['route'] ) )
		$_GET['route'] = NULL;

	ob_start();

	// Routing to the requested page

	if ( $_GET['route'] === 'apply' )
		require 'routes/apply.html';
	elseif ( $_GET['route'] === 'assignments' )
		require 'routes/assignments.html';
	elseif ( $_GET['route'] === 'attendance' )
		require 'routes/attendance.html';
	elseif ( $_GET['route'] === 'classrooms' )
		require 'routes/classrooms.html';
	elseif ( $_GET['route'] === 'course_management' )
		require 'routes/course_management.html';
	elseif ( $_GET['route'] === 'create_assignment' )
		require 'routes/create_assignment.html';
	elseif ( $_GET['route'] === 'create_classroom' )
		require 'routes/create_classroom.html';
	elseif ( $_GET['route'] === 'create_course' )
		require 'routes/create_course.html';
	elseif ( $_GET['route'] === 'create_lecture' )
		require 'routes/create_lecture.html';
	elseif ( $_GET['route'] === 'create_user' )
		require 'routes/create_user.html';
	elseif ( str_fit ( 'edit_assignment_[1-9]\d{0,15}', $_GET['route'] ) )
		require 'routes/edit_assignment.html';
	elseif ( str_fit ( 'edit_classroom_[1-9]\d{0,15}', $_GET['route'] ) )
		require 'routes/edit_classroom.html';
	elseif ( str_fit ( 'edit_course_[1-9]\d{0,15}', $_GET['route'] ) )
		require 'routes/edit_course.html';
	elseif ( str_fit ( 'edit_lecture_[1-9]\d{0,15}', $_GET['route'] ) )
		require 'routes/edit_lecture.html';
	elseif ( str_fit ( 'edit_user_[1-9]\d{0,15}', $_GET['route'] ) )
		require 'routes/edit_user.html';
	elseif ( $_GET['route'] === 'enrolments' )
		require 'routes/enrolments.html';
	elseif ( str_fit ( 'grade_[1-9]\d{0,15}_[1-9]\d{0,15}', $_GET['route'] ) )
		require 'routes/grade.html';
	elseif ( str_fit ( 'grading_[1-9]\d{0,15}', $_GET['route'] ) )
		require 'routes/grading.html';
	elseif ( $_GET['route'] === 'lecture_schedule' )
		require 'routes/lecture_schedule.html';
	elseif ( $_GET['route'] === 'my_assignments' )
		require 'routes/my_assignments.html';
	elseif ( $_GET['route'] === 'my_courses' )
		require 'routes/my_courses.html';
	elseif ( $_GET['route'] === 'my_lectures' )
		require 'routes/my_lectures.html';
	elseif ( $_GET['route'] === 'signin' )
		require 'routes/signin.html';
	elseif ( str_fit ( 'submit_assignment_[1-9]\d{0,15}', $_GET['route'] ) )
		require 'routes/submit_assignment.html';
	elseif ( $_GET['route'] === 'user_management' )
		require 'routes/user_management.html';
	else
		require 'routes/home.html';

	$CONTENT = ob_get_clean();
}
if ( $_SERVER['REQUEST_METHOD'] === 'POST' )
	require 'actions/index.php';

require 'static/layout.html';