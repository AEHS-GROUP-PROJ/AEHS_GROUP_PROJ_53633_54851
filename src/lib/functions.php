<?php

function route ( $route )

# Reroutes user to the specified route

{
	global $JSON;

	if ( str_fit ( '[a-z_\d]{1,256}', (string) $route ) )
		$JSON['route'] = (string) $route;
}

function in ( $val )

# Returns TRUE if any of the args matches $val, otherwise returns FALSE

{
	foreach ( func_get_args () as $k => $arg )
		if ( $k )
			if ( $val === $arg )
				return TRUE;
			elseif ( is_array ( $arg ) )
				foreach ( $arg as $i )
					if ( in ( $val, $i ) )
						return TRUE;

	return FALSE;
}

function str_fit ( $regexp, $str, $cs = FALSE )

# Returns TRUE if $str matches $regexp, otherwise returns FALSE

{
	return mb_ereg_match ( '^('.$regexp.')$', (string) $str, 'msr'.( $cs ? '' : 'i' ) );
}

function str_html ( $str, $multiline = FALSE, $textarea = FALSE )

# Escapes special HTML chars in $str

{
	$str = htmlspecialchars ( (string) $str );

	if ( $multiline )
	{
		if ( $textarea )
			return str_rep ( '\n', '&#010;', $str );

		$str = str_rep ( '\n\n', '</p><p>', $str );
		$str = str_rep ( '\n'  , '<br>'   , $str );

		return '<p>'.$str.'</p>';
	}

	return str_rep ( '\n+', ' ', $str );
}

function str_json ( $val )

# Returns a JSON-encoded string

{
	return json_encode ( $val, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE );
}

function str_len ( $str )

# Returns the multibyte length of $str

{
	return mb_strlen ( (string) $str );
}

function str_rand ( $len = 16 )

# Generates random alphanumeric token strings

{
	$set = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

	$res = '';

	for ( $i = 0; $i < $len && $i < 1000; $i++ )
		$res .= $set[rand ( 0, 61 )];

	return $res;
}

function str_rep ( $regex, $alt, $str, $cs = FALSE )

# Returns $str with $alt put in place of every $regex match

{
	return mb_ereg_replace ( $regex, (string) $alt, (string) $str, 'msr'.( $cs ? '' : 'i' ) );
}

function str_sub ( $str, $start, $len = NULL )

# Returns $len chars of $str, starting from position $start

{
	return mb_substr ( (string) $str, $start, $len );
}

function str_wash ( $str, $multiline = FALSE )

# Washes $str of all the unnesessary whitespace and returns it

{
	$str = explode ( "\n", (string) $str );

	foreach ( $str as $k => $i )
	{
		$str[$k] = trim ( str_rep ( '\s+' , ' ', $i ) );

		if ( str_len ( $str[$k] ) ) continue;

		if ( !$multiline || !isset ( $str[$k - 1] ) || !str_len ( $str[$k - 1] ) )
			unset ( $str[$k] );
	}

	return implode ( $multiline ? "\n" : ' ', $str );
}

function dom_id ( $id )

# Returns an 8 char alphanumeric ID to be associated with an HTML ID

{
	global $DOM_IDS;

	if ( !isset ( $DOM_IDS[(string) $id] ) )
		$DOM_IDS[(string) $id] = str_rand ( 8 );

	return $DOM_IDS[(string) $id];
}

function message ( $text, $type = 0 )

/*

Displays a message to the client

Message types:

0 - Neutral (default)
1 - Success (green)
2 - Warning (yellow)
3 - Error (red)

*/

{
	global $JSON;

	$text = str_wash ( $text );

	if ( !str_len ( $text ) )
		return;

	if ( str_len ( $text ) > 1000 )
		$text = str_sub ( $str, 0, 999 ).'…';

	if ( !in ( $type, 1, 2, 3 ) )
		$type = 0;

	$JSON['message'] = [ 'text' => $text, 'type' => $type ];
}