<?php

if
(
	!mb_internal_encoding ( 'UTF-8' ) ||
	!mb_regex_encoding ( 'UTF-8' ) ||
	mb_regex_set_options ( 'pr' ) !== 'pr'
)
	exit ( 'Unable to initialise Unicode' );

require 'lib/database.php';
require 'lib/functions.php';

$LAYOUT = [ 'menu' => NULL, 'content' => NULL ];

if ( $_SERVER['REQUEST_METHOD'] === 'GET' )
{
	if ( !isset ( $_GET['route'] ) )
		$_GET['route'] = 'register';

	if ( $_GET['route'] === 'register' )
		require 'routes/register.php';
}
if ( $_SERVER['REQUEST_METHOD'] === 'POST' )
	require 'actions/index.php';

require 'static/layout.html';