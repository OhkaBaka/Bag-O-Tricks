<?php
//6Zu, 6uZ, Z6u, Zu6, u6Z, uZ6

function perm( $input ) {
	global $loopz;
	$array = (is_array($input) ? $input :str_split($input) );
	if(1 == count($array)) return $array;
	$result = array();
	foreach($array as $key => $head){
		foreach( perm(array_diff_key($array, array($key => $head))) as $tail){
			$result[] = $head . $tail;
		}
	}

	$retval = array_unique( $retval );
	$len_ret = count( $retval );
	$vals_ret = implode( ",",array_values( $retval ) );

	return array( $vals_ret, $len_ret );

}

$l7=perm( "abcdefg" );
print $l7[0] . "<br>" . $l7[1] . "<hr>";
