<?php

// Access check

if ( !$_USER['is_admin'] && !$_USER['is_lecturer'] )
{
	message ( 'Access denied', 3 );

	return;
}

// Input checks

if ( !isset ( $_POST['announcement'] ) || !str_fit ( '[1-9]\d{0,15}', $_POST['announcement'] ) )
{
	message ( 'Payload missing', 3 );

	return;
}

// Deleting the announcement record

if ( sql ( 'DELETE FROM `announcements` WHERE `announcements`.id='.$_POST['announcement'], 1 ) )
	message ( 'Announcement successfully deleted', 1 );

route ( 'announcements' );