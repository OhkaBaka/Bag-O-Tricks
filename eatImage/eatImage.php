<?php
	$imgTarget = 'introvert_small_gray_8.gif';
	$img = imagecreatefromgif( $imgTarget );
	$imgSize = getimagesize( $imgTarget );
	$imgColorCount = imagecolorstotal( $img );
	$blox_width = 5;
	$blox_height = 5;
	$imgStripHeight = 140;
	$imgStripPad_height = $imgStripHeight - $imgSize[1];

	function rgbhex( $colorIn ){
		return '#' . str_pad( dechex( $colorIn[red] ), 2, 0, 'STR_PAD_LEFT' ) . str_pad( dechex( $colorIn[green] ), 2, 0, 'STR_PAD_LEFT' ) . str_pad( dechex( $colorIn[blue] ), 2, 0, 'STR_PAD_LEFT' );
	}
	function normdist($X, $mean, $sdev) {
		// Syntax: normdist( x, mean, standard_dev )
		// I did not "write" this... nor do I fully understand it...
		// it is math that uses seemingly random floats
		// to give me probabilities.  Yay Math-Heads!
		$res = 0;
		$x = ($X - $mean) / $sdev;
		if ($x == 0) {
			$res = 0.5;
		} else {
			$odsqrt2pi = 1 / ( sqrt( 2 * pi() ) );
			// One divided the square root of pi times two? ... ?? ... Thats not real math... thats crazy talk you say when you are trying to confuse someone or make a math joke.
			$t = 1 / (1 + 0.2316419 * abs($x));
			$t *= $odsqrt2pi * exp(-0.5 * $x * $x) * (0.31938153 + $t * (-0.356563782 + $t * (1.781477937 + $t * (-1.821255978 + $t * 1.330274429))));
			// Part of me wants to know where those numbers come from.  Part of me is scared of the answer.
			if ($x >= 0) {
			  $res = 1 - $t;
			} else {
			  $res = $t;
			}
		}
		return $res;
	}

	$colorIndex = array();
	for( $icix=0; $icix<$imgColorCount; $icix++ ){
		$colorIndex[$icix]=rgbhex( imagecolorsforindex( $img, $icix ) );
	}
	$light = rgbhex( imagecolorsforindex( $img, imagecolorclosest( $img, 254, 254, 254 ) ) );
	$dark = rgbhex( imagecolorsforindex( $img, imagecolorclosest( $img, 0, 0, 0 ) ) );
	$bloxelJSON = "[";

	for( $hix=0; $hix<($imgStripHeight); $hix++ ){
		$rowJSON .= "";
		for( $wix=0; $wix<$imgSize[0]; $wix++ ){
			$useRow = ceil( normdist( $hix, 0, $imgSize[1] ) * ( $hix * ( $imgSize[1] / $imgStripHeight ) ) );
			$hexColor = $colorIndex[ imagecolorat( $img, $wix, $useRow ) ];
			if( $rowJSON != "" )$rowJSON .= ","
			$rowJSON .= $hexColor;
		}
		$bloxelJSON .= "[ " . $rowJSON . " ]";
	}

	$bloxelJSON .= "]";
?>
