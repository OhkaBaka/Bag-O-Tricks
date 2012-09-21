<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<style>
			body{ margin: 0px; padding: 0px; background-color:white; }
			#bodyDiv{ display: block; position: relative; margin: auto; top: 0px; bottom: 0px; background-color:#FFFFCC; border: 3px single #FFFF00; padding: 0px; }
			#mainDiv{ display: block; position: relative; margin: auto; top: 0px; bottom: 0px; background-color:#FFCCCC; border: 3px single #FF0000; padding: 0px; width: 1100px; }

			#contentDiv{
				display:block;
				position:absolute;
				top: 0;
				bottom: 0;
				width:650px;
				margin: 0px auto;
				padding: 10px;
				background-color:#CCFFCC;
				border: 3px single #00CC00;
				border-width: 3px 0px;
				text-align: left;
				font: normal 9pt Verdana, Arial, Helvetica, sans-serif;
				overflow-x: hidden;
				overflow-y: auto;
				
			}
			#imgStrip{
				display:block;
				position:absolute;
				top:0px;
				left:0;
				width: 200px;
				height:100px;
				margin:0;
				border: 3px single blue;
			}
			#iB_container{
				position:absolute;
				display:block;
				bottom:0px;
				width: px;
				height: px;
			}
			.iB_bloxel{
				position: absolute;
				display: block;
				padding: 0px;
				margin: 0px;
				border: none;
				height: 5px;
				width: 5px;
				font: normal 8px/8px Verdana, Arial, Helvetica, sans-serif;
			}
	 
			li { margin-top: 5px; }
			p img { float:left; clear: left; }
	 
			 .hix_0 { top: 0px; }
	 .hix_1 { top: 5px; }
	 .hix_2 { top: 10px; }
	 .hix_3 { top: 15px; }
	 .hix_4 { top: 20px; }
	 .hix_5 { top: 25px; }
	 .hix_6 { top: 30px; }
	 .hix_7 { top: 35px; }
	 .hix_8 { top: 40px; }
	 .hix_9 { top: 45px; }
	 .hix_10 { top: 50px; }
	 .hix_11 { top: 55px; }
	 .hix_12 { top: 60px; }
	 .hix_13 { top: 65px; }
	 .hix_14 { top: 70px; }
	 .hix_15 { top: 75px; }
	 .hix_16 { top: 80px; }
	 .hix_17 { top: 85px; }
	 .hix_18 { top: 90px; }
	 .hix_19 { top: 95px; }
	 .hix_20 { top: 100px; }
	 .hix_21 { top: 105px; }
	 .hix_22 { top: 110px; }
	 .hix_23 { top: 115px; }
	 .wix_0 { left: 0px; }
	 .wix_1 { left: 5px; }
	 .wix_2 { left: 10px; }
	 .wix_3 { left: 15px; }
	 .wix_4 { left: 20px; }
	 .wix_5 { left: 25px; }
	 .wix_6 { left: 30px; }
	 .wix_7 { left: 35px; }
	 .wix_8 { left: 40px; }
	 .wix_9 { left: 45px; }
	 .wix_10 { left: 50px; }
	 .wix_11 { left: 55px; }
	 .wix_12 { left: 60px; }
	 .wix_13 { left: 65px; }
	 .wix_14 { left: 70px; }
	 .wix_15 { left: 75px; }
	 .wix_16 { left: 80px; }
	 .wix_17 { left: 85px; }
	 .wix_18 { left: 90px; }
	 .wix_19 { left: 95px; }
	 .wix_20 { left: 100px; }
	 .wix_21 { left: 105px; }
	 .wix_22 { left: 110px; }
	 .wix_23 { left: 115px; }
	 
		</style>
	 
		<script type="text/javascript" src="prototype.js" ></script>
		<script type="application/javascript">
			window.size = function(){
				var w = 0;
				var h = 0;
				if(!window.innerWidth){ // WINDOW PANE SIZE CROSS-BROWSER SIZE FUNCTION
					if(!(document.documentElement.clientWidth == 0)) {// IE STRICT
						w = document.documentElement.clientWidth;
						h = document.documentElement.clientHeight;
					} else { // IE QUIRKS
						w = document.body.clientWidth;
						h = document.body.clientHeight;
					}
				} else { // NOT IE
					w = window.innerWidth;
					h = window.innerHeight;
				}
				return {width:w,height:h};
			}
			getRule = function( selectText ){
				rules = document.styleSheets[0].cssRules;
				for( cix = 0; cix<rules.length; cix++ ){
					if( rules.item( cix ).selectorText == selectText.replace(/^ */,"").replace(/ *$/,"") ) {
						return rules.item( cix );
					}
				}
				return false;
			}
			doLoaded = function(){
				imgWidth = 48;
				imgHeight = 48;
	 
				// FRAME HEIGHT DRIVEN BLOX SIZE
				bloxHeight = Math.round( window.size().height / imgHeight );
				bloxWidth = bloxHeight;
	 
				imgStripHeight = ( imgHeight * bloxHeight );
				imgStripWidth = ( imgWidth * bloxWidth ) + 1;
	 
				$( "mainDiv" ).style.height = ( window.size().height + 0 ) + "px";
		
				$( "imgStrip" ).style.height = ( window.size().height + 2 ) + "px";
				$( "imgStrip" ).style.width = imgStripWidth + "px";
		
				$( "iB_container" ).style.width = imgStripWidth + "px";
				$( "iB_container" ).style.height = imgStripHeight + "px";
	 
				$( "contentDiv" ).style.width = parseInt( $( "mainDiv" ).style.width ) - imgStripHeight + "px";
				$( "contentDiv" ).style.height = imgStripHeight + "px";
	 
				/* SIZE CHANGE IS UNESCESSARY ON FIXED IMAGE SIZE
				getRule( '.iB_bloxel' ).style.width = bloxWidth + "px";
				getRule( '.iB_bloxel' ).style.height = bloxHeight + "px";
	 
				for( wix=0; wix<imgWidth; wix++ ){
					getRule( '.wix_' + wix ).style.left = ( bloxWidth * wix ) + "px";
				}
	 
				for( hix=0; hix<imgHeight; hix++ ){
					getRule( '.hix_' + hix ).style.top = ( bloxHeight * hix ) + "px";
				}
				*/
			}
	 
			/*
			THIS CODE HIGHLIGHTS THE MOUSEOVER X AND Y BLOX AS YOU MOVE AROUND.  IF YOU ARE OVER THE IMAGE STRIP
			ELEMENT IT RENDERS ALL THE MATCHING X AND MATCHING Y BLOX DIVS WHITE, (IF YOU ARE OVER THE BODY OF THE
			DOCUMENT IT ONLY RENDERS THE MATCHING Y ELEMENTS).
	 
			WHILE THIS IS PRETTY COOL (AND IN MANY WAYS, THE IMPETUS OF THE PROJECT), IT EATS CPUS FOR BREAKFAST.
			I NEED TO MAKE IT MORE EFFICIENT (AGAIN) AND TRY TO GET IT DOWN TO A REASONABLE RESOURCE DEVOURING LEVEL
	 
			I'VE SAID IMPETUS 8 BAJILLION TIMES IN MY LIFE... BUT I HAD TO LOOK IT UP JUST NOW BECAUSE I
			DIDN'T HAVE ANY IDEA HOW IT WAS SPELLED.  IMPOTICE SEEMED LOGICAL, BUT FELT WHOLLY INCORRECT.
	 
			var adjColor = false;
			var oldx = -1;
			var oldy = -1;
			$(document).ready(function () {
				$("#bodyDiv").mousemove(function(e){
					if( !adjColor ){
						adjColor = true;
						var bx = Math.floor( e.pageX / 5 );
						var by = Math.floor( e.pageY / 5 );
						
						$( ".hix_" + oldy ).css( "filter", "alpha(opacity=100)" );
						$( ".hix_" + oldy ).css( "opacity", "1" );
						$( ".wix_" + oldx ).css( "filter", "alpha(opacity=100)" );
						$( ".wix_" + oldx ).css( "opacity", "1" );
	 
						$( ".hix_" + by ).css( "filter", "alpha(opacity=25)" );
						$( ".hix_" + by ).css( "opacity", "0.25" );
						$( ".wix_" + bx ).css( "filter", "alpha(opacity=25)" );
						$( ".wix_" + bx ).css( "opacity", "0.25" );
	 
						oldx = bx;
						oldy = by;
						$("#updateDiv").html( "bx, by : " + bx + ", " + by + "<br />" );
						$("#updateDiv").text( "oldx, oldy : " + oldx + ", " + oldy + "<br />" );
						adjColor = false;
					}
				});
			});
			*/
	 
			Event.observe( window, 'load', doLoaded );
	 
		</script>
	</head>
	<body>
		<div id="bodyDiv" style="display:block;position:relative;text-align:center; ">
			<div id="mainDiv" >
				<div id="contentDiv" >
					<p>eatImage takes a gif, ingests it, and returns the pixels in a text based format (specifically a collection of absolute positioned DIV elements).</p>
				</div>
				<div id="imgStrip" >
					<div id='iB_container'>
						<div class='iB_bloxel wix_0 hix_0' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_1 hix_0' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_2 hix_0' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_3 hix_0' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_4 hix_0' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_5 hix_0' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_6 hix_0' style='background-color: #d6d6d6' >&nbsp;</div>
						<div class='iB_bloxel wix_7 hix_0' style='background-color: #d6d6d6' >&nbsp;</div>
						<div class='iB_bloxel wix_8 hix_0' style='background-color: #d6d6d6' >&nbsp;</div>
						<div class='iB_bloxel wix_9 hix_0' style='background-color: #d6d6d6' >&nbsp;</div>
						<div class='iB_bloxel wix_10 hix_0' style='background-color: #d6d6d6' >&nbsp;</div>
						<div class='iB_bloxel wix_11 hix_0' style='background-color: #d6d6d6' >&nbsp;</div>
						<div class='iB_bloxel wix_12 hix_0' style='background-color: #d6d6d6' >&nbsp;</div>
						<div class='iB_bloxel wix_13 hix_0' style='background-color: #d6d6d6' >&nbsp;</div>
						<div class='iB_bloxel wix_14 hix_0' style='background-color: #d6d6d6' >&nbsp;</div>
						<div class='iB_bloxel wix_15 hix_0' style='background-color: #d6d6d6' >&nbsp;</div>
						<div class='iB_bloxel wix_16 hix_0' style='background-color: #d6d6d6' >&nbsp;</div>
						<div class='iB_bloxel wix_17 hix_0' style='background-color: #d6d6d6' >&nbsp;</div>
						<div class='iB_bloxel wix_18 hix_0' style='background-color: #747474' >&nbsp;</div>
						<div class='iB_bloxel wix_19 hix_0' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_20 hix_0' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_21 hix_0' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_22 hix_0' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_23 hix_0' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_0 hix_1' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_1 hix_1' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_2 hix_1' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_3 hix_1' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_4 hix_1' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_5 hix_1' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_6 hix_1' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_7 hix_1' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_8 hix_1' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_9 hix_1' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_10 hix_1' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_11 hix_1' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_12 hix_1' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_13 hix_1' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_14 hix_1' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_15 hix_1' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_16 hix_1' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_17 hix_1' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_18 hix_1' style='background-color: #dedede' >&nbsp;</div>
						<div class='iB_bloxel wix_19 hix_1' style='background-color: #838383' >&nbsp;</div>
						<div class='iB_bloxel wix_20 hix_1' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_21 hix_1' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_22 hix_1' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_23 hix_1' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_0 hix_2' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_1 hix_2' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_2 hix_2' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_3 hix_2' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_4 hix_2' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_5 hix_2' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_6 hix_2' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_7 hix_2' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_8 hix_2' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_9 hix_2' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_10 hix_2' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_11 hix_2' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_12 hix_2' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_13 hix_2' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_14 hix_2' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_15 hix_2' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_16 hix_2' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_17 hix_2' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_18 hix_2' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_19 hix_2' style='background-color: #dedede' >&nbsp;</div>
						<div class='iB_bloxel wix_20 hix_2' style='background-color: #747474' >&nbsp;</div>
						<div class='iB_bloxel wix_21 hix_2' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_22 hix_2' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_23 hix_2' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_0 hix_3' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_1 hix_3' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_2 hix_3' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_3 hix_3' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_4 hix_3' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_5 hix_3' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_6 hix_3' style='background-color: #de6a6a' >&nbsp;</div>
						<div class='iB_bloxel wix_7 hix_3' style='background-color: #e25252' >&nbsp;</div>
						<div class='iB_bloxel wix_8 hix_3' style='background-color: #de6a6a' >&nbsp;</div>
						<div class='iB_bloxel wix_9 hix_3' style='background-color: #faaeae' >&nbsp;</div>
						<div class='iB_bloxel wix_10 hix_3' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_11 hix_3' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_12 hix_3' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_13 hix_3' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_14 hix_3' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_15 hix_3' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_16 hix_3' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_17 hix_3' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_18 hix_3' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_19 hix_3' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_20 hix_3' style='background-color: #dedede' >&nbsp;</div>
						<div class='iB_bloxel wix_21 hix_3' style='background-color: #838383' >&nbsp;</div>
						<div class='iB_bloxel wix_22 hix_3' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_23 hix_3' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_0 hix_4' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_1 hix_4' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_2 hix_4' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_3 hix_4' style='background-color: #f6eded' >&nbsp;</div>
						<div class='iB_bloxel wix_4 hix_4' style='background-color: #e96363' >&nbsp;</div>
						<div class='iB_bloxel wix_5 hix_4' style='background-color: #fcc5c5' >&nbsp;</div>
						<div class='iB_bloxel wix_6 hix_4' style='background-color: #fcb6b6' >&nbsp;</div>
						<div class='iB_bloxel wix_7 hix_4' style='background-color: #f89595' >&nbsp;</div>
						<div class='iB_bloxel wix_8 hix_4' style='background-color: #f67b7b' >&nbsp;</div>
						<div class='iB_bloxel wix_9 hix_4' style='background-color: #f25a5a' >&nbsp;</div>
						<div class='iB_bloxel wix_10 hix_4' style='background-color: #e14b4b' >&nbsp;</div>
						<div class='iB_bloxel wix_11 hix_4' style='background-color: #e29c9c' >&nbsp;</div>
						<div class='iB_bloxel wix_12 hix_4' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_13 hix_4' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_14 hix_4' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_15 hix_4' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_16 hix_4' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_17 hix_4' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_18 hix_4' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_19 hix_4' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_20 hix_4' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_21 hix_4' style='background-color: #dedede' >&nbsp;</div>
						<div class='iB_bloxel wix_22 hix_4' style='background-color: #747474' >&nbsp;</div>
						<div class='iB_bloxel wix_23 hix_4' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_0 hix_5' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_1 hix_5' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_2 hix_5' style='background-color: #f2d4d4' >&nbsp;</div>
						<div class='iB_bloxel wix_3 hix_5' style='background-color: #f9bbbb' >&nbsp;</div>
						<div class='iB_bloxel wix_4 hix_5' style='background-color: #fcd7d7' >&nbsp;</div>
						<div class='iB_bloxel wix_5 hix_5' style='background-color: #ffcccc' >&nbsp;</div>
						<div class='iB_bloxel wix_6 hix_5' style='background-color: #fbaeae' >&nbsp;</div>
						<div class='iB_bloxel wix_7 hix_5' style='background-color: #f89595' >&nbsp;</div>
						<div class='iB_bloxel wix_8 hix_5' style='background-color: #f67b7b' >&nbsp;</div>
						<div class='iB_bloxel wix_9 hix_5' style='background-color: #f46b6b' >&nbsp;</div>
						<div class='iB_bloxel wix_10 hix_5' style='background-color: #f05252' >&nbsp;</div>
						<div class='iB_bloxel wix_11 hix_5' style='background-color: #e23c3c' >&nbsp;</div>
						<div class='iB_bloxel wix_12 hix_5' style='background-color: #c94040' >&nbsp;</div>
						<div class='iB_bloxel wix_13 hix_5' style='background-color: #6894c2' >&nbsp;</div>
						<div class='iB_bloxel wix_14 hix_5' style='background-color: #6894c2' >&nbsp;</div>
						<div class='iB_bloxel wix_15 hix_5' style='background-color: #598bbf' >&nbsp;</div>
						<div class='iB_bloxel wix_16 hix_5' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_17 hix_5' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_18 hix_5' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_19 hix_5' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_20 hix_5' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_21 hix_5' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_22 hix_5' style='background-color: #dedede' >&nbsp;</div>
						<div class='iB_bloxel wix_23 hix_5' style='background-color: #404040' >&nbsp;</div>
						<div class='iB_bloxel wix_0 hix_6' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_1 hix_6' style='background-color: #f6eded' >&nbsp;</div>
						<div class='iB_bloxel wix_2 hix_6' style='background-color: #f59c9c' >&nbsp;</div>
						<div class='iB_bloxel wix_3 hix_6' style='background-color: #ffcccc' >&nbsp;</div>
						<div class='iB_bloxel wix_4 hix_6' style='background-color: #ffcccc' >&nbsp;</div>
						<div class='iB_bloxel wix_5 hix_6' style='background-color: #fbbbbb' >&nbsp;</div>
						<div class='iB_bloxel wix_6 hix_6' style='background-color: #f6a4a4' >&nbsp;</div>
						<div class='iB_bloxel wix_7 hix_6' style='background-color: #f28484' >&nbsp;</div>
						<div class='iB_bloxel wix_8 hix_6' style='background-color: #f57373' >&nbsp;</div>
						<div class='iB_bloxel wix_9 hix_6' style='background-color: #f36363' >&nbsp;</div>
						<div class='iB_bloxel wix_10 hix_6' style='background-color: #f04a4a' >&nbsp;</div>
						<div class='iB_bloxel wix_11 hix_6' style='background-color: #ee3a3a' >&nbsp;</div>
						<div class='iB_bloxel wix_12 hix_6' style='background-color: #e42222' >&nbsp;</div>
						<div class='iB_bloxel wix_13 hix_6' style='background-color: #e37373' >&nbsp;</div>
						<div class='iB_bloxel wix_14 hix_6' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_15 hix_6' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_16 hix_6' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_17 hix_6' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_18 hix_6' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_19 hix_6' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_20 hix_6' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_21 hix_6' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_22 hix_6' style='background-color: #efefef' >&nbsp;</div>
						<div class='iB_bloxel wix_23 hix_6' style='background-color: #292929' >&nbsp;</div>
						<div class='iB_bloxel wix_0 hix_7' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_1 hix_7' style='background-color: #e25252' >&nbsp;</div>
						<div class='iB_bloxel wix_2 hix_7' style='background-color: #fcb6b6' >&nbsp;</div>
						<div class='iB_bloxel wix_3 hix_7' style='background-color: #fbbbbb' >&nbsp;</div>
						<div class='iB_bloxel wix_4 hix_7' style='background-color: #fbaeae' >&nbsp;</div>
						<div class='iB_bloxel wix_5 hix_7' style='background-color: #f59c9c' >&nbsp;</div>
						<div class='iB_bloxel wix_6 hix_7' style='background-color: #f28484' >&nbsp;</div>
						<div class='iB_bloxel wix_7 hix_7' style='background-color: #f46b6b' >&nbsp;</div>
						<div class='iB_bloxel wix_8 hix_7' style='background-color: #f36363' >&nbsp;</div>
						<div class='iB_bloxel wix_9 hix_7' style='background-color: #f05252' >&nbsp;</div>
						<div class='iB_bloxel wix_10 hix_7' style='background-color: #ee3a3a' >&nbsp;</div>
						<div class='iB_bloxel wix_11 hix_7' style='background-color: #ed2929' >&nbsp;</div>
						<div class='iB_bloxel wix_12 hix_7' style='background-color: #e21818' >&nbsp;</div>
						<div class='iB_bloxel wix_13 hix_7' style='background-color: #c11111' >&nbsp;</div>
						<div class='iB_bloxel wix_14 hix_7' style='background-color: #598bbf' >&nbsp;</div>
						<div class='iB_bloxel wix_15 hix_7' style='background-color: #598bbf' >&nbsp;</div>
						<div class='iB_bloxel wix_16 hix_7' style='background-color: #4281c2' >&nbsp;</div>
						<div class='iB_bloxel wix_17 hix_7' style='background-color: #4281c2' >&nbsp;</div>
						<div class='iB_bloxel wix_18 hix_7' style='background-color: #347ac4' >&nbsp;</div>
						<div class='iB_bloxel wix_19 hix_7' style='background-color: #2073c6' >&nbsp;</div>
						<div class='iB_bloxel wix_20 hix_7' style='background-color: #2073c6' >&nbsp;</div>
						<div class='iB_bloxel wix_21 hix_7' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_22 hix_7' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_23 hix_7' style='background-color: #292929' >&nbsp;</div>
						<div class='iB_bloxel wix_0 hix_8' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_1 hix_8' style='background-color: #f05252' >&nbsp;</div>
						<div class='iB_bloxel wix_2 hix_8' style='background-color: #f59c9c' >&nbsp;</div>
						<div class='iB_bloxel wix_3 hix_8' style='background-color: #f59c9c' >&nbsp;</div>
						<div class='iB_bloxel wix_4 hix_8' style='background-color: #f89595' >&nbsp;</div>
						<div class='iB_bloxel wix_5 hix_8' style='background-color: #f67b7b' >&nbsp;</div>
						<div class='iB_bloxel wix_6 hix_8' style='background-color: #f46b6b' >&nbsp;</div>
						<div class='iB_bloxel wix_7 hix_8' style='background-color: #f25a5a' >&nbsp;</div>
						<div class='iB_bloxel wix_8 hix_8' style='background-color: #f05252' >&nbsp;</div>
						<div class='iB_bloxel wix_9 hix_8' style='background-color: #ee3a3a' >&nbsp;</div>
						<div class='iB_bloxel wix_10 hix_8' style='background-color: #ee3131' >&nbsp;</div>
						<div class='iB_bloxel wix_11 hix_8' style='background-color: #e42222' >&nbsp;</div>
						<div class='iB_bloxel wix_12 hix_8' style='background-color: #d51111' >&nbsp;</div>
						<div class='iB_bloxel wix_13 hix_8' style='background-color: #c50808' >&nbsp;</div>
						<div class='iB_bloxel wix_14 hix_8' style='background-color: #da8484' >&nbsp;</div>
						<div class='iB_bloxel wix_15 hix_8' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_16 hix_8' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_17 hix_8' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_18 hix_8' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_19 hix_8' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_20 hix_8' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_21 hix_8' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_22 hix_8' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_23 hix_8' style='background-color: #333333' >&nbsp;</div>
						<div class='iB_bloxel wix_0 hix_9' style='background-color: #de6a6a' >&nbsp;</div>
						<div class='iB_bloxel wix_1 hix_9' style='background-color: #e25252' >&nbsp;</div>
						<div class='iB_bloxel wix_2 hix_9' style='background-color: #f28484' >&nbsp;</div>
						<div class='iB_bloxel wix_3 hix_9' style='background-color: #f67b7b' >&nbsp;</div>
						<div class='iB_bloxel wix_4 hix_9' style='background-color: #f57373' >&nbsp;</div>
						<div class='iB_bloxel wix_5 hix_9' style='background-color: #f36363' >&nbsp;</div>
						<div class='iB_bloxel wix_6 hix_9' style='background-color: #f25a5a' >&nbsp;</div>
						<div class='iB_bloxel wix_7 hix_9' style='background-color: #f04a4a' >&nbsp;</div>
						<div class='iB_bloxel wix_8 hix_9' style='background-color: #ee3a3a' >&nbsp;</div>
						<div class='iB_bloxel wix_9 hix_9' style='background-color: #ee3131' >&nbsp;</div>
						<div class='iB_bloxel wix_10 hix_9' style='background-color: #e42222' >&nbsp;</div>
						<div class='iB_bloxel wix_11 hix_9' style='background-color: #df1111' >&nbsp;</div>
						<div class='iB_bloxel wix_12 hix_9' style='background-color: #d50909' >&nbsp;</div>
						<div class='iB_bloxel wix_13 hix_9' style='background-color: #c50808' >&nbsp;</div>
						<div class='iB_bloxel wix_14 hix_9' style='background-color: #aa1212' >&nbsp;</div>
						<div class='iB_bloxel wix_15 hix_9' style='background-color: #396494' >&nbsp;</div>
						<div class='iB_bloxel wix_16 hix_9' style='background-color: #4375ad' >&nbsp;</div>
						<div class='iB_bloxel wix_17 hix_9' style='background-color: #4281c2' >&nbsp;</div>
						<div class='iB_bloxel wix_18 hix_9' style='background-color: #347ac4' >&nbsp;</div>
						<div class='iB_bloxel wix_19 hix_9' style='background-color: #2073c6' >&nbsp;</div>
						<div class='iB_bloxel wix_20 hix_9' style='background-color: #2073c6' >&nbsp;</div>
						<div class='iB_bloxel wix_21 hix_9' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_22 hix_9' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_23 hix_9' style='background-color: #333333' >&nbsp;</div>
						<div class='iB_bloxel wix_0 hix_10' style='background-color: #c42b2b' >&nbsp;</div>
						<div class='iB_bloxel wix_1 hix_10' style='background-color: #e23c3c' >&nbsp;</div>
						<div class='iB_bloxel wix_2 hix_10' style='background-color: #f05252' >&nbsp;</div>
						<div class='iB_bloxel wix_3 hix_10' style='background-color: #f25a5a' >&nbsp;</div>
						<div class='iB_bloxel wix_4 hix_10' style='background-color: #f25a5a' >&nbsp;</div>
						<div class='iB_bloxel wix_5 hix_10' style='background-color: #f04a4a' >&nbsp;</div>
						<div class='iB_bloxel wix_6 hix_10' style='background-color: #ef4242' >&nbsp;</div>
						<div class='iB_bloxel wix_7 hix_10' style='background-color: #ee3a3a' >&nbsp;</div>
						<div class='iB_bloxel wix_8 hix_10' style='background-color: #ee3131' >&nbsp;</div>
						<div class='iB_bloxel wix_9 hix_10' style='background-color: #e42222' >&nbsp;</div>
						<div class='iB_bloxel wix_10 hix_10' style='background-color: #df1111' >&nbsp;</div>
						<div class='iB_bloxel wix_11 hix_10' style='background-color: #d50909' >&nbsp;</div>
						<div class='iB_bloxel wix_12 hix_10' style='background-color: #ce0808' >&nbsp;</div>
						<div class='iB_bloxel wix_13 hix_10' style='background-color: #c41919' >&nbsp;</div>
						<div class='iB_bloxel wix_14 hix_10' style='background-color: #a70909' >&nbsp;</div>
						<div class='iB_bloxel wix_15 hix_10' style='background-color: #bdbdbd' >&nbsp;</div>
						<div class='iB_bloxel wix_16 hix_10' style='background-color: #c5c5c5' >&nbsp;</div>
						<div class='iB_bloxel wix_17 hix_10' style='background-color: #dedede' >&nbsp;</div>
						<div class='iB_bloxel wix_18 hix_10' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_19 hix_10' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_20 hix_10' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_21 hix_10' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_22 hix_10' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_23 hix_10' style='background-color: #333333' >&nbsp;</div>
						<div class='iB_bloxel wix_0 hix_11' style='background-color: #be2929' >&nbsp;</div>
						<div class='iB_bloxel wix_1 hix_11' style='background-color: #d93434' >&nbsp;</div>
						<div class='iB_bloxel wix_2 hix_11' style='background-color: #ef4242' >&nbsp;</div>
						<div class='iB_bloxel wix_3 hix_11' style='background-color: #ef4242' >&nbsp;</div>
						<div class='iB_bloxel wix_4 hix_11' style='background-color: #ef4242' >&nbsp;</div>
						<div class='iB_bloxel wix_5 hix_11' style='background-color: #ee3a3a' >&nbsp;</div>
						<div class='iB_bloxel wix_6 hix_11' style='background-color: #ee3131' >&nbsp;</div>
						<div class='iB_bloxel wix_7 hix_11' style='background-color: #ed2929' >&nbsp;</div>
						<div class='iB_bloxel wix_8 hix_11' style='background-color: #e42222' >&nbsp;</div>
						<div class='iB_bloxel wix_9 hix_11' style='background-color: #df1111' >&nbsp;</div>
						<div class='iB_bloxel wix_10 hix_11' style='background-color: #d50909' >&nbsp;</div>
						<div class='iB_bloxel wix_11 hix_11' style='background-color: #c50808' >&nbsp;</div>
						<div class='iB_bloxel wix_12 hix_11' style='background-color: #c41919' >&nbsp;</div>
						<div class='iB_bloxel wix_13 hix_11' style='background-color: #c23232' >&nbsp;</div>
						<div class='iB_bloxel wix_14 hix_11' style='background-color: #aa1212' >&nbsp;</div>
						<div class='iB_bloxel wix_15 hix_11' style='background-color: #396494' >&nbsp;</div>
						<div class='iB_bloxel wix_16 hix_11' style='background-color: #396494' >&nbsp;</div>
						<div class='iB_bloxel wix_17 hix_11' style='background-color: #3168a0' >&nbsp;</div>
						<div class='iB_bloxel wix_18 hix_11' style='background-color: #236ab2' >&nbsp;</div>
						<div class='iB_bloxel wix_19 hix_11' style='background-color: #2073c6' >&nbsp;</div>
						<div class='iB_bloxel wix_20 hix_11' style='background-color: #2073c6' >&nbsp;</div>
						<div class='iB_bloxel wix_21 hix_11' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_22 hix_11' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_23 hix_11' style='background-color: #333333' >&nbsp;</div>
						<div class='iB_bloxel wix_0 hix_12' style='background-color: #d3b8b8' >&nbsp;</div>
						<div class='iB_bloxel wix_1 hix_12' style='background-color: #c72323' >&nbsp;</div>
						<div class='iB_bloxel wix_2 hix_12' style='background-color: #e72929' >&nbsp;</div>
						<div class='iB_bloxel wix_3 hix_12' style='background-color: #e72929' >&nbsp;</div>
						<div class='iB_bloxel wix_4 hix_12' style='background-color: #e72929' >&nbsp;</div>
						<div class='iB_bloxel wix_5 hix_12' style='background-color: #e42222' >&nbsp;</div>
						<div class='iB_bloxel wix_6 hix_12' style='background-color: #e21818' >&nbsp;</div>
						<div class='iB_bloxel wix_7 hix_12' style='background-color: #df1111' >&nbsp;</div>
						<div class='iB_bloxel wix_8 hix_12' style='background-color: #d50909' >&nbsp;</div>
						<div class='iB_bloxel wix_9 hix_12' style='background-color: #ce0808' >&nbsp;</div>
						<div class='iB_bloxel wix_10 hix_12' style='background-color: #c50808' >&nbsp;</div>
						<div class='iB_bloxel wix_11 hix_12' style='background-color: #c11111' >&nbsp;</div>
						<div class='iB_bloxel wix_12 hix_12' style='background-color: #c42b2b' >&nbsp;</div>
						<div class='iB_bloxel wix_13 hix_12' style='background-color: #ce4b4b' >&nbsp;</div>
						<div class='iB_bloxel wix_14 hix_12' style='background-color: #bd6868' >&nbsp;</div>
						<div class='iB_bloxel wix_15 hix_12' style='background-color: #c5c5c5' >&nbsp;</div>
						<div class='iB_bloxel wix_16 hix_12' style='background-color: #cccccc' >&nbsp;</div>
						<div class='iB_bloxel wix_17 hix_12' style='background-color: #d6d6d6' >&nbsp;</div>
						<div class='iB_bloxel wix_18 hix_12' style='background-color: #dedede' >&nbsp;</div>
						<div class='iB_bloxel wix_19 hix_12' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_20 hix_12' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_21 hix_12' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_22 hix_12' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_23 hix_12' style='background-color: #333333' >&nbsp;</div>
						<div class='iB_bloxel wix_0 hix_13' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_1 hix_13' style='background-color: #b81111' >&nbsp;</div>
						<div class='iB_bloxel wix_2 hix_13' style='background-color: #c11111' >&nbsp;</div>
						<div class='iB_bloxel wix_3 hix_13' style='background-color: #d51111' >&nbsp;</div>
						<div class='iB_bloxel wix_4 hix_13' style='background-color: #d51111' >&nbsp;</div>
						<div class='iB_bloxel wix_5 hix_13' style='background-color: #d51111' >&nbsp;</div>
						<div class='iB_bloxel wix_6 hix_13' style='background-color: #d50909' >&nbsp;</div>
						<div class='iB_bloxel wix_7 hix_13' style='background-color: #ce0808' >&nbsp;</div>
						<div class='iB_bloxel wix_8 hix_13' style='background-color: #c50808' >&nbsp;</div>
						<div class='iB_bloxel wix_9 hix_13' style='background-color: #be0909' >&nbsp;</div>
						<div class='iB_bloxel wix_10 hix_13' style='background-color: #b81111' >&nbsp;</div>
						<div class='iB_bloxel wix_11 hix_13' style='background-color: #be2929' >&nbsp;</div>
						<div class='iB_bloxel wix_12 hix_13' style='background-color: #ce4b4b' >&nbsp;</div>
						<div class='iB_bloxel wix_13 hix_13' style='background-color: #c94040' >&nbsp;</div>
						<div class='iB_bloxel wix_14 hix_13' style='background-color: #446993' >&nbsp;</div>
						<div class='iB_bloxel wix_15 hix_13' style='background-color: #446993' >&nbsp;</div>
						<div class='iB_bloxel wix_16 hix_13' style='background-color: #3d6b9e' >&nbsp;</div>
						<div class='iB_bloxel wix_17 hix_13' style='background-color: #3168a0' >&nbsp;</div>
						<div class='iB_bloxel wix_18 hix_13' style='background-color: #236ab2' >&nbsp;</div>
						<div class='iB_bloxel wix_19 hix_13' style='background-color: #2571bd' >&nbsp;</div>
						<div class='iB_bloxel wix_20 hix_13' style='background-color: #1c71c6' >&nbsp;</div>
						<div class='iB_bloxel wix_21 hix_13' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_22 hix_13' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_23 hix_13' style='background-color: #333333' >&nbsp;</div>
						<div class='iB_bloxel wix_0 hix_14' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_1 hix_14' style='background-color: #eedede' >&nbsp;</div>
						<div class='iB_bloxel wix_2 hix_14' style='background-color: #b40808' >&nbsp;</div>
						<div class='iB_bloxel wix_3 hix_14' style='background-color: #be0909' >&nbsp;</div>
						<div class='iB_bloxel wix_4 hix_14' style='background-color: #be0909' >&nbsp;</div>
						<div class='iB_bloxel wix_5 hix_14' style='background-color: #be0909' >&nbsp;</div>
						<div class='iB_bloxel wix_6 hix_14' style='background-color: #be0909' >&nbsp;</div>
						<div class='iB_bloxel wix_7 hix_14' style='background-color: #be0909' >&nbsp;</div>
						<div class='iB_bloxel wix_8 hix_14' style='background-color: #b81111' >&nbsp;</div>
						<div class='iB_bloxel wix_9 hix_14' style='background-color: #b81717' >&nbsp;</div>
						<div class='iB_bloxel wix_10 hix_14' style='background-color: #be2929' >&nbsp;</div>
						<div class='iB_bloxel wix_11 hix_14' style='background-color: #ce4b4b' >&nbsp;</div>
						<div class='iB_bloxel wix_12 hix_14' style='background-color: #e67878' >&nbsp;</div>
						<div class='iB_bloxel wix_13 hix_14' style='background-color: #b04343' >&nbsp;</div>
						<div class='iB_bloxel wix_14 hix_14' style='background-color: #c5c5c5' >&nbsp;</div>
						<div class='iB_bloxel wix_15 hix_14' style='background-color: #cccccc' >&nbsp;</div>
						<div class='iB_bloxel wix_16 hix_14' style='background-color: #d6d6d6' >&nbsp;</div>
						<div class='iB_bloxel wix_17 hix_14' style='background-color: #dedede' >&nbsp;</div>
						<div class='iB_bloxel wix_18 hix_14' style='background-color: #e6e6e6' >&nbsp;</div>
						<div class='iB_bloxel wix_19 hix_14' style='background-color: #efefef' >&nbsp;</div>
						<div class='iB_bloxel wix_20 hix_14' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_21 hix_14' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_22 hix_14' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_23 hix_14' style='background-color: #333333' >&nbsp;</div>
						<div class='iB_bloxel wix_0 hix_15' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_1 hix_15' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_2 hix_15' style='background-color: #e4bfbf' >&nbsp;</div>
						<div class='iB_bloxel wix_3 hix_15' style='background-color: #bb1919' >&nbsp;</div>
						<div class='iB_bloxel wix_4 hix_15' style='background-color: #b81717' >&nbsp;</div>
						<div class='iB_bloxel wix_5 hix_15' style='background-color: #b81717' >&nbsp;</div>
						<div class='iB_bloxel wix_6 hix_15' style='background-color: #b81717' >&nbsp;</div>
						<div class='iB_bloxel wix_7 hix_15' style='background-color: #bc2121' >&nbsp;</div>
						<div class='iB_bloxel wix_8 hix_15' style='background-color: #c42b2b' >&nbsp;</div>
						<div class='iB_bloxel wix_9 hix_15' style='background-color: #c94040' >&nbsp;</div>
						<div class='iB_bloxel wix_10 hix_15' style='background-color: #d65a5a' >&nbsp;</div>
						<div class='iB_bloxel wix_11 hix_15' style='background-color: #f28484' >&nbsp;</div>
						<div class='iB_bloxel wix_12 hix_15' style='background-color: #aa1212' >&nbsp;</div>
						<div class='iB_bloxel wix_13 hix_15' style='background-color: #507194' >&nbsp;</div>
						<div class='iB_bloxel wix_14 hix_15' style='background-color: #507194' >&nbsp;</div>
						<div class='iB_bloxel wix_15 hix_15' style='background-color: #426fa0' >&nbsp;</div>
						<div class='iB_bloxel wix_16 hix_15' style='background-color: #426fa0' >&nbsp;</div>
						<div class='iB_bloxel wix_17 hix_15' style='background-color: #3876b4' >&nbsp;</div>
						<div class='iB_bloxel wix_18 hix_15' style='background-color: #236ab2' >&nbsp;</div>
						<div class='iB_bloxel wix_19 hix_15' style='background-color: #2571bd' >&nbsp;</div>
						<div class='iB_bloxel wix_20 hix_15' style='background-color: #1c71c6' >&nbsp;</div>
						<div class='iB_bloxel wix_21 hix_15' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_22 hix_15' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_23 hix_15' style='background-color: #333333' >&nbsp;</div>
						<div class='iB_bloxel wix_0 hix_16' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_1 hix_16' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_2 hix_16' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_3 hix_16' style='background-color: #eedede' >&nbsp;</div>
						<div class='iB_bloxel wix_4 hix_16' style='background-color: #ac1717' >&nbsp;</div>
						<div class='iB_bloxel wix_5 hix_16' style='background-color: #d96161' >&nbsp;</div>
						<div class='iB_bloxel wix_6 hix_16' style='background-color: #d65a5a' >&nbsp;</div>
						<div class='iB_bloxel wix_7 hix_16' style='background-color: #d65a5a' >&nbsp;</div>
						<div class='iB_bloxel wix_8 hix_16' style='background-color: #de6a6a' >&nbsp;</div>
						<div class='iB_bloxel wix_9 hix_16' style='background-color: #f28484' >&nbsp;</div>
						<div class='iB_bloxel wix_10 hix_16' style='background-color: #ce4b4b' >&nbsp;</div>
						<div class='iB_bloxel wix_11 hix_16' style='background-color: #b04343' >&nbsp;</div>
						<div class='iB_bloxel wix_12 hix_16' style='background-color: #c5c5c5' >&nbsp;</div>
						<div class='iB_bloxel wix_13 hix_16' style='background-color: #cccccc' >&nbsp;</div>
						<div class='iB_bloxel wix_14 hix_16' style='background-color: #d6d6d6' >&nbsp;</div>
						<div class='iB_bloxel wix_15 hix_16' style='background-color: #dedede' >&nbsp;</div>
						<div class='iB_bloxel wix_16 hix_16' style='background-color: #dedede' >&nbsp;</div>
						<div class='iB_bloxel wix_17 hix_16' style='background-color: #e6e6e6' >&nbsp;</div>
						<div class='iB_bloxel wix_18 hix_16' style='background-color: #efefef' >&nbsp;</div>
						<div class='iB_bloxel wix_19 hix_16' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_20 hix_16' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_21 hix_16' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_22 hix_16' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_23 hix_16' style='background-color: #333333' >&nbsp;</div>
						<div class='iB_bloxel wix_0 hix_17' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_1 hix_17' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_2 hix_17' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_3 hix_17' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_4 hix_17' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_5 hix_17' style='background-color: #f6eded' >&nbsp;</div>
						<div class='iB_bloxel wix_6 hix_17' style='background-color: #aa1212' >&nbsp;</div>
						<div class='iB_bloxel wix_7 hix_17' style='background-color: #a70909' >&nbsp;</div>
						<div class='iB_bloxel wix_8 hix_17' style='background-color: #aa1212' >&nbsp;</div>
						<div class='iB_bloxel wix_9 hix_17' style='background-color: #8d3e46' >&nbsp;</div>
						<div class='iB_bloxel wix_10 hix_17' style='background-color: #677b92' >&nbsp;</div>
						<div class='iB_bloxel wix_11 hix_17' style='background-color: #677b92' >&nbsp;</div>
						<div class='iB_bloxel wix_12 hix_17' style='background-color: #56799f' >&nbsp;</div>
						<div class='iB_bloxel wix_13 hix_17' style='background-color: #56799f' >&nbsp;</div>
						<div class='iB_bloxel wix_14 hix_17' style='background-color: #56799f' >&nbsp;</div>
						<div class='iB_bloxel wix_15 hix_17' style='background-color: #4375ad' >&nbsp;</div>
						<div class='iB_bloxel wix_16 hix_17' style='background-color: #4375ad' >&nbsp;</div>
						<div class='iB_bloxel wix_17 hix_17' style='background-color: #3876b4' >&nbsp;</div>
						<div class='iB_bloxel wix_18 hix_17' style='background-color: #2571bd' >&nbsp;</div>
						<div class='iB_bloxel wix_19 hix_17' style='background-color: #1c71c6' >&nbsp;</div>
						<div class='iB_bloxel wix_20 hix_17' style='background-color: #1c71c6' >&nbsp;</div>
						<div class='iB_bloxel wix_21 hix_17' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_22 hix_17' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_23 hix_17' style='background-color: #333333' >&nbsp;</div>
						<div class='iB_bloxel wix_0 hix_18' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_1 hix_18' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_2 hix_18' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_3 hix_18' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_4 hix_18' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_5 hix_18' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_6 hix_18' style='background-color: #efefef' >&nbsp;</div>
						<div class='iB_bloxel wix_7 hix_18' style='background-color: #cccccc' >&nbsp;</div>
						<div class='iB_bloxel wix_8 hix_18' style='background-color: #cccccc' >&nbsp;</div>
						<div class='iB_bloxel wix_9 hix_18' style='background-color: #cccccc' >&nbsp;</div>
						<div class='iB_bloxel wix_10 hix_18' style='background-color: #d6d6d6' >&nbsp;</div>
						<div class='iB_bloxel wix_11 hix_18' style='background-color: #d6d6d6' >&nbsp;</div>
						<div class='iB_bloxel wix_12 hix_18' style='background-color: #dedede' >&nbsp;</div>
						<div class='iB_bloxel wix_13 hix_18' style='background-color: #dedede' >&nbsp;</div>
						<div class='iB_bloxel wix_14 hix_18' style='background-color: #e6e6e6' >&nbsp;</div>
						<div class='iB_bloxel wix_15 hix_18' style='background-color: #e6e6e6' >&nbsp;</div>
						<div class='iB_bloxel wix_16 hix_18' style='background-color: #efefef' >&nbsp;</div>
						<div class='iB_bloxel wix_17 hix_18' style='background-color: #efefef' >&nbsp;</div>
						<div class='iB_bloxel wix_18 hix_18' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_19 hix_18' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_20 hix_18' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_21 hix_18' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_22 hix_18' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_23 hix_18' style='background-color: #333333' >&nbsp;</div>
						<div class='iB_bloxel wix_0 hix_19' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_1 hix_19' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_2 hix_19' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_3 hix_19' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_4 hix_19' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_5 hix_19' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_6 hix_19' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_7 hix_19' style='background-color: #e6e6e6' >&nbsp;</div>
						<div class='iB_bloxel wix_8 hix_19' style='background-color: #d6d6d6' >&nbsp;</div>
						<div class='iB_bloxel wix_9 hix_19' style='background-color: #7a8a9c' >&nbsp;</div>
						<div class='iB_bloxel wix_10 hix_19' style='background-color: #73879e' >&nbsp;</div>
						<div class='iB_bloxel wix_11 hix_19' style='background-color: #6886a3' >&nbsp;</div>
						<div class='iB_bloxel wix_12 hix_19' style='background-color: #6886a3' >&nbsp;</div>
						<div class='iB_bloxel wix_13 hix_19' style='background-color: #5780ad' >&nbsp;</div>
						<div class='iB_bloxel wix_14 hix_19' style='background-color: #5780ad' >&nbsp;</div>
						<div class='iB_bloxel wix_15 hix_19' style='background-color: #4b7db3' >&nbsp;</div>
						<div class='iB_bloxel wix_16 hix_19' style='background-color: #4b7db3' >&nbsp;</div>
						<div class='iB_bloxel wix_17 hix_19' style='background-color: #3378bf' >&nbsp;</div>
						<div class='iB_bloxel wix_18 hix_19' style='background-color: #3378bf' >&nbsp;</div>
						<div class='iB_bloxel wix_19 hix_19' style='background-color: #2073c6' >&nbsp;</div>
						<div class='iB_bloxel wix_20 hix_19' style='background-color: #2073c6' >&nbsp;</div>
						<div class='iB_bloxel wix_21 hix_19' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_22 hix_19' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_23 hix_19' style='background-color: #333333' >&nbsp;</div>
						<div class='iB_bloxel wix_0 hix_20' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_1 hix_20' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_2 hix_20' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_3 hix_20' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_4 hix_20' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_5 hix_20' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_6 hix_20' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_7 hix_20' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_8 hix_20' style='background-color: #e6e6e6' >&nbsp;</div>
						<div class='iB_bloxel wix_9 hix_20' style='background-color: #e6e6e6' >&nbsp;</div>
						<div class='iB_bloxel wix_10 hix_20' style='background-color: #e6e6e6' >&nbsp;</div>
						<div class='iB_bloxel wix_11 hix_20' style='background-color: #e6e6e6' >&nbsp;</div>
						<div class='iB_bloxel wix_12 hix_20' style='background-color: #e6e6e6' >&nbsp;</div>
						<div class='iB_bloxel wix_13 hix_20' style='background-color: #efefef' >&nbsp;</div>
						<div class='iB_bloxel wix_14 hix_20' style='background-color: #efefef' >&nbsp;</div>
						<div class='iB_bloxel wix_15 hix_20' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_16 hix_20' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_17 hix_20' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_18 hix_20' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_19 hix_20' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_20 hix_20' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_21 hix_20' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_22 hix_20' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_23 hix_20' style='background-color: #292929' >&nbsp;</div>
						<div class='iB_bloxel wix_0 hix_21' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_1 hix_21' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_2 hix_21' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_3 hix_21' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_4 hix_21' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_5 hix_21' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_6 hix_21' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_7 hix_21' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_8 hix_21' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_9 hix_21' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_10 hix_21' style='background-color: #efefef' >&nbsp;</div>
						<div class='iB_bloxel wix_11 hix_21' style='background-color: #efefef' >&nbsp;</div>
						<div class='iB_bloxel wix_12 hix_21' style='background-color: #efefef' >&nbsp;</div>
						<div class='iB_bloxel wix_13 hix_21' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_14 hix_21' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_15 hix_21' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_16 hix_21' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_17 hix_21' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_18 hix_21' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_19 hix_21' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_20 hix_21' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_21 hix_21' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_22 hix_21' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_23 hix_21' style='background-color: #292929' >&nbsp;</div>
						<div class='iB_bloxel wix_0 hix_22' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_1 hix_22' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_2 hix_22' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_3 hix_22' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_4 hix_22' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_5 hix_22' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_6 hix_22' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_7 hix_22' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_8 hix_22' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_9 hix_22' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_10 hix_22' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_11 hix_22' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_12 hix_22' style='background-color: #f7f7f7' >&nbsp;</div>
						<div class='iB_bloxel wix_13 hix_22' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_14 hix_22' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_15 hix_22' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_16 hix_22' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_17 hix_22' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_18 hix_22' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_19 hix_22' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_20 hix_22' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_21 hix_22' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_22 hix_22' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_23 hix_22' style='background-color: #333333' >&nbsp;</div>
						<div class='iB_bloxel wix_0 hix_23' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_1 hix_23' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_2 hix_23' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_3 hix_23' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_4 hix_23' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_5 hix_23' style='background-color: #ffffff' >&nbsp;</div>
						<div class='iB_bloxel wix_6 hix_23' style='background-color: #333333' >&nbsp;</div>
						<div class='iB_bloxel wix_7 hix_23' style='background-color: #292929' >&nbsp;</div>
						<div class='iB_bloxel wix_8 hix_23' style='background-color: #292929' >&nbsp;</div>
						<div class='iB_bloxel wix_9 hix_23' style='background-color: #292929' >&nbsp;</div>
						<div class='iB_bloxel wix_10 hix_23' style='background-color: #292929' >&nbsp;</div>
						<div class='iB_bloxel wix_11 hix_23' style='background-color: #292929' >&nbsp;</div>
						<div class='iB_bloxel wix_12 hix_23' style='background-color: #292929' >&nbsp;</div>
						<div class='iB_bloxel wix_13 hix_23' style='background-color: #292929' >&nbsp;</div>
						<div class='iB_bloxel wix_14 hix_23' style='background-color: #292929' >&nbsp;</div>
						<div class='iB_bloxel wix_15 hix_23' style='background-color: #292929' >&nbsp;</div>
						<div class='iB_bloxel wix_16 hix_23' style='background-color: #292929' >&nbsp;</div>
						<div class='iB_bloxel wix_17 hix_23' style='background-color: #292929' >&nbsp;</div>
						<div class='iB_bloxel wix_18 hix_23' style='background-color: #292929' >&nbsp;</div>
						<div class='iB_bloxel wix_19 hix_23' style='background-color: #292929' >&nbsp;</div>
						<div class='iB_bloxel wix_20 hix_23' style='background-color: #292929' >&nbsp;</div>
						<div class='iB_bloxel wix_21 hix_23' style='background-color: #292929' >&nbsp;</div>
						<div class='iB_bloxel wix_22 hix_23' style='background-color: #292929' >&nbsp;</div>
						<div class='iB_bloxel wix_23 hix_23' style='background-color: #333333' >&nbsp;</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>

<? /*php
	$scaleDivision = 2;
	$imgTarget = 'icon.gif';
	$img = imagecreatefromgif( $imgTarget );
	$imgSize = getimagesize( $imgTarget );
	$bloxW = floor( $imgSize[0]/$scaleDivision );
	$bloxH = floor( $imgSize[1]/$scaleDivision );
	$imgColorCount = imagecolorstotal( $img );
	$bloxWidth = 5;
	$bloxHeight = 5;

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
	$lightmid = rgbhex( imagecolorsforindex( $img, imagecolorclosest( $img, 192, 192, 192 ) ) );
	$mid = rgbhex( imagecolorsforindex( $img, imagecolorclosest( $img, 128, 128, 128 ) ) );
	$darkmid = rgbhex( imagecolorsforindex( $img, imagecolorclosest( $img, 64, 64, 64 ) ) );
	$dark = rgbhex( imagecolorsforindex( $img, imagecolorclosest( $img, 0, 0, 0 ) ) );

	$bloxelHtml = "<div id='iB_container'>";

	for( $hix=0; $hix<$bloxH; $hix++ ){
		for( $wix=0; $wix<$bloxW; $wix++ ){
			$hexColor = $colorIndex[ imagecolorat( $img, $wix*$scaleDivision, $hix*$scaleDivision ) ];
			$bloxelHtml .= "<div class='iB_bloxel wix_$wix hix_$hix' style='background-color: $hexColor' >&nbsp;</div>";
		}
	}
	$bloxelHtml .= "</div>";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<head>
	<style>
		body{ margin: 0px; padding: 0px; background-color:white; }
		#bodyDiv{ margin: 0px; padding: 0px; display: block; position: relative; color:<?php echo $dark; ?>; }
		#mainDiv{ background-color:<?php echo $light; ?>; width: 1100px; display: block; position: relative; margin:0 auto; overflow:hidden;}

		#contentDiv{
			display:block;
			position:absolute;
			top:0;
			left:350px;
			width:650px;
			height:700px; 
			padding: 10px;
			border: 3px double <? echo $lightmid ?>;
			background-color: <? echo $light ?>;
			border-width: 3px 0px;
			text-align: left;
			font: normal 9pt Verdana, Arial, Helvetica, sans-serif;
			overflow-x: none;
			overflow-y: auto;
		}
		table.tableImage {
			border: none;
			padding: 0px;
			margin: 0px;
			border-collapse:collapse;
		}
		#imgStrip{
			display:block;
			position:absolute;
			top:0px;
			left:0;
			width: 200px;
			height:100px;
			margin:0;
		}
		#iB_container{
			position:absolute;
			display:block;
			bottom:0px;
			width: <?php $bloxW ?>px;
			height: <?php $bloxH ?>px;
		}
		.iB_bloxel{
			position: absolute;
			display: block;
			padding: 0px;
			margin: 0px;
			border: none;
			height: 5px;
			width: 5px;
			font: normal 8px/8px Verdana, Arial, Helvetica, sans-serif;
		}

		li { margin-top: 5px; }
		p img { float:left; clear: left; }

		<?
			for( $hix=0; $hix<$bloxH; $hix++ ){
				echo " .hix_" . $hix . " { top: " . $hix*5 . "px; }\n";
			}
			for( $wix=0; $wix<$bloxW; $wix++ ){
				echo " .wix_" . $wix . " { left: " . $wix*5 . "px; }\n";
			}
		?>

	</style>

	<script type="text/javascript" src="prototype.js" ></script>
	<script type="application/javascript">
		window.size = function(){
			var w = 0;
			var h = 0;
			if(!window.innerWidth){ // WINDOW PANE SIZE CROSS-BROWSER SIZE FUNCTION
				if(!(document.documentElement.clientWidth == 0)) {// IE STRICT
					w = document.documentElement.clientWidth;
					h = document.documentElement.clientHeight;
				} else { // IE QUIRKS
					w = document.body.clientWidth;
					h = document.body.clientHeight;
				}
			} else { // NOT IE
				w = window.innerWidth;
				h = window.innerHeight;
			}
			return {width:w,height:h};
		}
		getRule = function( selectText ){
			rules = document.styleSheets[0].cssRules;
			for( cix = 0; cix<rules.length; cix++ ){
*/			
//				if( rules.item( cix ).selectorText == selectText.replace(/^ */,"").replace(/ *$/,"") ) {
/*
					return rules.item( cix );
				}
			}
			return false;
		}
		doLoaded = function(){
			imgWidth = <? echo $imgSize[0]; ?>;
			imgHeight = <? echo $imgSize[1]; ?>;

			// FRAME HEIGHT DRIVEN BLOX SIZE
			bloxHeight = Math.round( window.size().height / imgHeight );
			bloxWidth = bloxHeight;

			imgStripHeight = ( imgHeight * bloxHeight );
			imgStripWidth = ( imgWidth * bloxWidth ) + 1;

			$( "mainDiv" ).style.height = ( window.size().height + 0 ) + "px";
	
			$( "imgStrip" ).style.height = ( window.size().height + 2 ) + "px";
			$( "imgStrip" ).style.width = imgStripWidth + "px";
	
			$( "iB_container" ).style.width = imgStripWidth + "px";
			$( "iB_container" ).style.height = imgStripHeight + "px";

			$( "contentDiv" ).style.width = parseInt( $( "mainDiv" ).style.width ) - imgStripHeight + "px";
			$( "contentDiv" ).style.height = imgStripHeight + "px";

			/* SIZE CHANGE IS UNESCESSARY ON FIXED IMAGE SIZE
			getRule( '.iB_bloxel' ).style.width = bloxWidth + "px";
			getRule( '.iB_bloxel' ).style.height = bloxHeight + "px";

			for( wix=0; wix<imgWidth; wix++ ){
				getRule( '.wix_' + wix ).style.left = ( bloxWidth * wix ) + "px";
			}

			for( hix=0; hix<imgHeight; hix++ ){
				getRule( '.hix_' + hix ).style.top = ( bloxHeight * hix ) + "px";
			}
			*/
//		}

		/*
		THIS CODE HIGHLIGHTS THE MOUSEOVER X AND Y BLOX AS YOU MOVE AROUND.  IF YOU ARE OVER THE IMAGE STRIP
		ELEMENT IT RENDERS ALL THE MATCHING X AND MATCHING Y BLOX DIVS WHITE, (IF YOU ARE OVER THE BODY OF THE
		DOCUMENT IT ONLY RENDERS THE MATCHING Y ELEMENTS).

		WHILE THIS IS PRETTY COOL (AND IN MANY WAYS, THE IMPETUS OF THE PROJECT), IT EATS CPUS FOR BREAKFAST.
		I NEED TO MAKE IT MORE EFFICIENT (AGAIN) AND TRY TO GET IT DOWN TO A REASONABLE RESOURCE DEVOURING LEVEL

		I'VE SAID IMPETUS 8 BAJILLION TIMES IN MY LIFE... BUT I HAD TO LOOK IT UP JUST NOW BECAUSE I
		DIDN'T HAVE ANY IDEA HOW IT WAS SPELLED.  IMPOTICE SEEMED LOGICAL, BUT FELT WHOLLY INCORRECT.

		var adjColor = false;
		var oldx = -1;
		var oldy = -1;
		$(document).ready(function () {
			$("#bodyDiv").mousemove(function(e){
				if( !adjColor ){
					adjColor = true;
					var bx = Math.floor( e.pageX / 5 );
					var by = Math.floor( e.pageY / 5 );
					
					$( ".hix_" + oldy ).css( "filter", "alpha(opacity=100)" );
					$( ".hix_" + oldy ).css( "opacity", "1" );
					$( ".wix_" + oldx ).css( "filter", "alpha(opacity=100)" );
					$( ".wix_" + oldx ).css( "opacity", "1" );

					$( ".hix_" + by ).css( "filter", "alpha(opacity=25)" );
					$( ".hix_" + by ).css( "opacity", "0.25" );
					$( ".wix_" + bx ).css( "filter", "alpha(opacity=25)" );
					$( ".wix_" + bx ).css( "opacity", "0.25" );

					oldx = bx;
					oldy = by;
					$("#updateDiv").html( "bx, by : " + bx + ", " + by + "<br />" );
					$("#updateDiv").text( "oldx, oldy : " + oldx + ", " + oldy + "<br />" );
					adjColor = false;
				}
			});
		});
		*/
/*
		Event.observe( window, 'load', doLoaded );

	</script>
</head>
<body>
	<div id="bodyDiv" style="display:block;position:relative;text-align:center; ">
		<div id="mainDiv" >
			<div id="contentDiv" >
				<p>eatImage takes a gif, ingests it, and returns the pixels in a text based format (specifically a collection of absolute positioned DIV elements).</p>
			</div>
			<div id="imgStrip" >
				<?php echo $bloxelHtml; ?>
			</div>
		</div>
	</div>
</body>
*/ ?>