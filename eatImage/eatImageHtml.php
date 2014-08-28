<?php
	$bloxelSize = 2;
	$imgTarget = 'introvert_tiny.gif';
	$img = imagecreatefromgif( $imgTarget );
	$imgSize = getimagesize( $imgTarget );
	$imgColorCount = imagecolorstotal( $img );
	$imgStripHeight = 150;
	$imgStripMaxWidth = 150;

	function rgbhex( $colorIn ){
		return '#' . str_pad( dechex( $colorIn[red] ), 2, 0, STR_PAD_LEFT ) . str_pad( dechex( $colorIn[green] ), 2, 0, STR_PAD_LEFT ) . str_pad( dechex( $colorIn[blue] ), 2, 0, STR_PAD_LEFT );
	}
	function normdist($X, $mean, $sdev) {
		// Syntax: normdist( x, mean, standard_dev )
		// I did not "write" this... nor do I fully understand it...
		// it is math that uses seemingly random floats
		// to give me probabilities. Yay Math-Heads!
		$res = 0;
		$x = ($X - $mean) / $sdev;
		if ($x == 0) {
			$res = 0.5;
		} else {
			$odsqrt2pi = 1 / ( sqrt( 2 * pi() ) );
			// One divided the square root of pi times two? ... ?? ... Thats not real math... thats crazy talk you say when you are trying to confuse someone or make a math joke.
			$t = 1 / (1 + 0.2316419 * abs($x));
			$t *= $odsqrt2pi * exp(-0.5 * $x * $x) * (0.31938153 + $t * (-0.356563782 + $t * (1.781477937 + $t * (-1.821255978 + $t * 1.330274429))));
			// Part of me wants to know where those numbers come from. Part of me is scared of the answer.
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
	$lightmid = rgbhex( imagecolorsforindex( $img, imagecolorclosest( $img, 192, 192, 192 ) ) );
	$mid = rgbhex( imagecolorsforindex( $img, imagecolorclosest( $img, 128, 128, 128 ) ) );
	$darkmid = rgbhex( imagecolorsforindex( $img, imagecolorclosest( $img, 64, 64, 64 ) ) );
	$dark = rgbhex( imagecolorsforindex( $img, imagecolorclosest( $img, 0, 0, 0 ) ) );

	$bloxelHtml = "<div id='iB_container'>";

	for( $hix=0; $hix<$imgStripHeight; $hix++ ){
		$useRow = floor( ( normdist( $hix, $imgStripHeight, ( $imgSize[1]*0.8 ), 1) * 2 ) * $imgSize[1] );
		for( $wix=0; $wix<$imgSize[0]; $wix++ ){
			$hexColor = $colorIndex[ imagecolorat( $img, $wix, $useRow ) ];
			$bloxelHtml .= "<div class='iB_bloxel wix_$wix hix_$hix' style='background-color: $hexColor;' >&nbsp;</div>\n";
		}
	}
	$bloxelHtml .= "</div>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<style>
			body{ margin: 0px; padding: 0px; background-color:white; }
			#bodyDiv{ display: block; position: relative; margin: auto; top: 0px; bottom: 0px; padding: 0px; height: auto; overflow: hidden; }
			#mainDiv{ display: block; position: relative; margin: auto; top: 0px; bottom: 0px; padding: 0px; height: auto; width: 1100px; }

			#contentDiv{
				display:block;
				position:absolute;
				width: 780px;
				height: auto;
				top: 2px;
				bottom: 2px;
				right: 0;
				z-index: 5;
				margin: 0px auto;
				padding: 0px;
				text-align: left;
				font: normal 9pt/11pt Verdana, Arial, Helvetica, sans-serif;
				overflow-x: hidden;
				overflow-y: auto;
			}
			#contentDiv p br { margin-bottom: 5px; }
			#contentDiv p, #contentDiv ul { padding: 0; margin: 5px; }
			#contentDiv p img { float:left; clear: left; }
			#contentDiv ul li { margin: 5px 20px; padding: 0px 10px; list-style-type:circle; list-style-position:outside; }

			#contentDiv h3 { font: bold 14pt Verdana, Arial, Helvetica, sans-serif; color: #336633; margin: 0; padding: 0; }
			#contentDiv h4 { font: normal 12pt Verdana, Arial, Helvetica, sans-serif; color: #227722; margin: 0; padding: 0; }

			#imgStrip{
				display:block;
				position:absolute;
				width: 300px;
				height: auto;
				top:0px;
				bottom:0px;
				left:0px;
				margin: 0px;
				padding: 0px;
				z-index: 10;
				overflow: hidden;
			}
			#iB_container{
				position:absolute;
				top: 0px;
				margin: 0 auto;
				display:block;
				width: 300px;
				height: auto;
				overflow: hidden;
			}
			.iB_bloxel{
				position: absolute;
				display: block;
				padding: 0px;
				margin: 0px;
				border: none;
				height: 2px;
				width: 2px;
				font: normal 8px/8px Verdana, Arial, Helvetica, sans-serif;
			}

			<?
				for( $hix=0; $hix<$imgStripHeight; $hix++ ){
					echo "\t\t\t.hix_" . $hix . " { top: " . $hix . "px; }\n";
				}
				for( $wix=0; $wix<$imgSize[0]; $wix++ ){
					echo "\t\t\t.wix_" . $wix . " { left: " . $wix . "px; }\n";
				}
			?>
	
		</style>
	
		<!--- <script type="text/javascript" src="prototype.js" ></script> --->
		<script language="javascript" type="text/javascript">
			var imgWidth = <? echo $imgSize[0]; ?>;
			var imgHeight = <? echo $imgStripHeight; ?>;
		
			//SIMPLE ELEMENT SELECTOR
			//SIMPLE ELEMENT SELECTOR
			var $ = function(a){
				return document.getElementById( a );
			}
		
			//SIMPLE STYLE RULE SELECTOR
			//SIMPLE STYLE RULE SELECTOR
			var $R = function( selector ){
				var rules = document.styleSheets[0].rules || document.styleSheets[0].cssRules;
				var returnAll =0;
				if( arguments.length == 2 ) returnAll = arguments[1];
				var matches = [];
				if( typeof( selector ) == 'string' && selector.indexOf( "/" ) == 0 && selector.indexOf( "/", 1 ) == selector.length - 1 ) eval( "selector = " + selector );
		
				if( typeof( selector ) == 'object' && selector instanceof RegExp ) useRE = true; else useRE = false;
		
				if( typeof( selector ) == 'string' || useRE ){
					for( rix in rules ){
						if( ( !useRE && rules[rix].selectorText == selector ) || ( useRE && selector.exec( rules[rix].selectorText ) ) ) {
							if( !returnAll ){
								return rules[rix];
								break;
							} else matches.push( rules[rix] );
						}
					}
				}
				return matches;
			}

			//SIMPLE EVENT MANAGEMENT
			//SIMPLE EVENT MANAGEMENT
			var eventAdd = function( elm, evt, func ){
				if( typeof( elm ) == "string" ) tElement = $( elm );
				else if( typeof( elm ) == "object" ) tElement = elm;
				
				if ( tElement.addEventListener ) {
					tElement.addEventListener( evt, func, false);
				} else if( tElement.attachEvent ){
					tElement.attachEvent ("on"+evt, func);
				} else {
					eval( "tElement.on" + evt + " = func" );
				}
			}
			
			//GET WINDOW SIZE
			//GET WINDOW SIZE
			var winSize = function(){
				var height=0;
				var width=0;
				if( !window.innerWidth ){ // WINDOW PANE SIZE CROSS-BROWSER SIZE FUNCTION
					if( !(document.documentElement.clientWidth == 0) ) { // IE STRICT
						width = document.documentElement.clientWidth;
						height = document.documentElement.clientHeight;
					} else { // IE QUIRKS
						width = document.body.clientWidth;
						height = document.body.clientHeight;
					}
				} else { // NOT IE
					width = window.innerWidth;
					height = window.innerHeight;
				}
				return { height: height, width: width };
			}

			//RESIZE IMAGE STRIP
			//RESIZE IMAGE STRIP
			var resizeImageStrip = function(){
				$( "bodyDiv" ).style.height = winSize().height + "px";
				$( "mainDiv" ).style.height = winSize().height + "px";
				$( "contentDiv" ).style.height = ( winSize().height -2 ) + "px";
				$( "imgStrip" ).style.height = winSize().height + "px";
				$( "iB_container" ).style.height = winSize().height + "px";

				// FRAME HEIGHT DRIVEN BLOX SIZE
				bloxSize = ( winSize().height / imgHeight ) ;
		
				$( "iB_container" ).style.width =  Math.floor( imgWidth * bloxSize ) + "px";
				$( "iB_container" ).style.left = ( $( "imgStrip" ).offsetWidth - parseInt( $( "iB_container" ).style.width ) ) / 2 + "px";

				bloxelRule = $R( '.iB_bloxel' );
				bloxelRule.style.width = Math.ceil( bloxSize ) + "px";
				bloxelRule.style.height = Math.ceil( bloxSize ) + "px";
		
				for( wix=0; wix<imgWidth; wix++ ){
					$R( '.wix_' + wix ).style.left = Math.round( bloxSize * wix ) + "px";
				}
		
				for( hix=0; hix<imgHeight; hix++ ){
					$R( '.hix_' + hix ).style.top = Math.round( bloxSize * hix ) + "px";
				}
			}

			var doLoaded = function(){
				resizeImageStrip();
			}
			
			eventAdd( window, "load", doLoaded );
			eventAdd( window, "resize", doLoaded );
		</script>
	</head>
	<body >
		<div id="bodyDiv" >
			<div id="mainDiv" >
				<div id="contentDiv" >
					<h3>eatImage</h3>
					<h4>takes a gif, ingests it, and returns the pixels in a text based format (html div elements).</h4>
					<p>
						This version... my proof of concept, has all the process and code wrapped up in a single PHP file.<br />
						My original idea was to create an interactive bitmap background, extending some ideas I had put into my box management API &ldquo;blox.&rdquo; <br />
						Technically speaking, most browsers are not-quite-ready for the level of processing... Internet Explorer is the exception, as it is WOEFULLY INCAPABLE of doing much of what I envisioned.<br />
						Blox died due to being ultimately overshadowed by other APIs. Bits of Blox still survive in the form of various scripts I've written, including the particle generator and map system in the GEngHIS application.<strong></strong><br />
						Now that all the other APIs have gotten kinda massive, I might re-envision Blox to fill a very specific role.<br />
						My proudest bit of code was the Normal Distribution logic used to stretch the image to fit the border column height. I am a fine programmer, and I tend to think people believe that that means I am a fine mathematician, and that is not the case at all. It is easy for me though, I LOVE learning interesting things: Discovering what KIND of equation I needed was a fantastic opportunity to learn about numbers.<br />
						The development version of eatImage, (which still has many bugs and can't be demo'd yet), has a much richer feature set: <br />
					</p>
					<ul type="disc">FEATURES: 
						<li>The only thing stopping this version from generating different images is that the base URL is hardcode, the newer version can accept uploads.</li>
						<li>Rather than reprocess the image every time it loads, eatImage dumps the conversion to a static JSON file (or database table), and serves that.</li>
						<li>It dumps the conversion to a static JSON file (or database table), and serves that, instead of reprocessing the file each time.<br />
								<em>I just had an idea for using (go figure) GIF style palette management to compress the amount of data I have to store / transfer.</em></li>
						<li>I intend to fully separate the code (I tend to construct on a single template, and break it out when it it is finished, or gets large enough to be easier to edit), in that form I can dynamically re-render the &quot;bloxel&quot; image via httpRequests.</li>
					</ul>
					<ul type="disc">ISSUES:
						<li>If you are using IE you have probably already discovered this, but JavaScript div management is SUBSTANTIALLY slower on IE than Mozilla. You wouldn't notice it normally, but in most of my current batch of applications I am generating and interacting with hundreds of boxes (the static version of this page has just shy of 1000 div elements).</li>
						<li>I can brick a Firefox 2.0 installation pretty quickly, Firefox3, and its better-but-still-broken memory leak, runs substantially smoother over time. </li>
						<li>I haven't found an efficient method in EITHER browser client to dynamically alter the bloxels on this scale without it looking cheap or destroying the client PC's processor.</li>
						<li>For human readable logic reasons more than aesthetics, I used a 8 color GIF in this demo. That limitation is exceedingly restrictive, but I've been so busy working on the engine that I forgot to update the upholstery.</li>
					</ul>
					<p><img src="introvert_tiny.gif" style="margin: 0px 3px" />The photo is called "The Introvert." It was taken by one of my best friends, and a brilliant photographer, Patty Mancini. The subject is me, circa 1993, in an alley outside our favorite dive bar in Naha, Okinawa in the Empire of Japan. The picture was the inspiration for the name and logo of my web media company "Introvert Productions," as well as the winner of several photo competitions and eventually a scholarship for my friend.</p>
					<div style="float:left;clear:both;width:95%" >&nbsp;</div>
				</div>
				<div id="imgStrip" >
					<?php echo $bloxelHtml; ?>
				</div>
			</div>
		</div>
	</body>
</html>