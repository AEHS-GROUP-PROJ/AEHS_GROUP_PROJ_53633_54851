<?php

if ( !$DB = mysqli_init () )
	exit ( 'Unable to initialize database connection' );

if ( !mysqli_real_connect ( $DB, 'localhost', 'root', 'root', 'sis', 3306 ) )
	exit ( 'Unable to connect to the database' );

if ( !mysqli_set_charset ( $DB, 'utf8mb4' ) )
	exit ( 'Unable to set up database charset' );

function sql ( $query, $single = FALSE )

/*

Performs an SQL request.

For SELECT/SHOW/DESCRIBE/EXPLAIN returns the result as an associative array.

For others - returns the count of rows affected.

*/

{
	global $DB;

	$result = mysqli_query ( $DB, $query );

	if ( mysqli_error ( $DB) )
		return NULL;

	$count = mysqli_affected_rows ( $DB );

	if ( $count < 0 || ( $single && $count > 1 ) )
		return NULL;

	if ( $result instanceof mysqli_result )
	{
		if ( $single )
			return $count ? mysqli_fetch_assoc ( $result ) : [];

		$RESULT = [];

		for ( $i = 0; $i < $count; $i++ )
			$RESULT[] = mysqli_fetch_assoc ( $result );

		mysqli_free_result ( $result );

		return $RESULT;
	}

	return $count;
}

function sql_escape ( $str, $len = NULL, $null = TRUE, $quot = TRUE )

// Escapes string to be safely used in SQL queries

{
	global $DB;

	if ( str_len ( $str = str_sub ( $str, 0, $len ) ) )
	{
		$str = mysqli_real_escape_string ( $DB, $str );

		return $quot ? '\''.$str.'\'' : $str;
	}

	if ( $null )
		return 'NULL';

	return $quot ? '\'\'' : '';
}