<?php

if ( !$DB = mysqli_init () )
	exit ( 'Unable to initialize database connection' );

if ( !mysqli_real_connect ( $DB, 'localhost', 'root', 'root', 'sis', 3306 ) )
	exit ( 'Unable to connect to the database' );

if ( !mysqli_set_charset ( $DB, 'utf8mb4' ) )
	exit ( 'Unable to set up database charset' );