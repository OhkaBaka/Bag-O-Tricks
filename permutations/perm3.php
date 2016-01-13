<?php

function insanePerm($input){
	$pArray = array();
	$pArray[ preg_replace("/(.)(.?)(.?)(.?)(.?)(.?)(.?)(.?)(.?)/","$1$2$3$4$5$6$7$8$9", $input ) ] = count( $pArray);
	$pArray[ preg_replace("/(.)(.?)(.?)(.?)(.?)(.?)(.?)(.?)(.?)/","$1$2$3$4$5$6$7$9$8", $input ) ] = count( $pArray);
	$pArray[ preg_replace("/(.)(.?)(.?)(.?)(.?)(.?)(.?)(.?)(.?)/","$1$2$3$4$5$6$8$7$9", $input ) ] = count( $pArray);
	$pArray[ preg_replace("/(.)(.?)(.?)(.?)(.?)(.?)(.?)(.?)(.?)/","$1$2$3$4$5$6$8$9$7", $input ) ] = count( $pArray);
	$pArray[ preg_replace("/(.)(.?)(.?)(.?)(.?)(.?)(.?)(.?)(.?)/","$1$2$3$4$5$6$9$7$8", $input ) ] = count( $pArray);
	$pArray[ preg_replace("/(.)(.?)(.?)(.?)(.?)(.?)(.?)(.?)(.?)/","$1$2$3$4$5$6$9$8$7", $input ) ] = count( $pArray);
	$pArray[ preg_replace("/(.)(.?)(.?)(.?)(.?)(.?)(.?)(.?)(.?)/","$1$2$3$4$5$7$6$8$9", $input ) ] = count( $pArray);
	$pArray[ preg_replace("/(.)(.?)(.?)(.?)(.?)(.?)(.?)(.?)(.?)/","$1$2$3$4$5$7$6$9$8", $input ) ] = count( $pArray);
	/* …30,000 more variations… */
	$pArray[ preg_replace("/(.)(.?)(.?)(.?)(.?)(.?)(.?)(.?)(.?)/","$9$8$7$6$5$3$2$4$1", $input ) ] = count( $pArray);
	$pArray[ preg_replace("/(.)(.?)(.?)(.?)(.?)(.?)(.?)(.?)(.?)/","$9$8$7$6$5$3$4$1$2", $input ) ] = count( $pArray);
	$pArray[ preg_replace("/(.)(.?)(.?)(.?)(.?)(.?)(.?)(.?)(.?)/","$9$8$7$6$5$3$4$2$1", $input ) ] = count( $pArray);
	$pArray[ preg_replace("/(.)(.?)(.?)(.?)(.?)(.?)(.?)(.?)(.?)/","$9$8$7$6$5$4$1$2$3", $input ) ] = count( $pArray);
	$pArray[ preg_replace("/(.)(.?)(.?)(.?)(.?)(.?)(.?)(.?)(.?)/","$9$8$7$6$5$4$1$3$2", $input ) ] = count( $pArray);
	$pArray[ preg_replace("/(.)(.?)(.?)(.?)(.?)(.?)(.?)(.?)(.?)/","$9$8$7$6$5$4$2$1$3", $input ) ] = count( $pArray);
	$pArray[ preg_replace("/(.)(.?)(.?)(.?)(.?)(.?)(.?)(.?)(.?)/","$9$8$7$6$5$4$2$3$1", $input ) ] = count( $pArray);
	$pArray[ preg_replace("/(.)(.?)(.?)(.?)(.?)(.?)(.?)(.?)(.?)/","$9$8$7$6$5$4$3$1$2", $input ) ] = count( $pArray);
	$pArray[ preg_replace("/(.)(.?)(.?)(.?)(.?)(.?)(.?)(.?)(.?)/","$9$8$7$6$5$4$3$2$1", $input ) ] = count( $pArray);

	$valueArray = array_flip( $pArray );
	asort( $valueArray);
	return implode( ",",array_values( $valueArray ) );
}

print insanePerm("goat") . " <br> : " . (99-1)99/2;

?>
