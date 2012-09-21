<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GEngHIS Map Builder</title>
	<style>
		td { font: mormal 10pt Verdana, Arial, Helvetica, sans-serif; text-decoration:none; text-align: center; margin: 0px; padding: 1px; border: 1px solid #CCCCCC;}

		.boardDiv, .boardDiv div { margin: 0; padding: 0px; }
		.boardDiv{ position: relative; }
		.columnDiv{ position: absolute; top:0px; overflow:hidden; }
		.tileDiv { position: absolute; left:0px; border: 1px solid green !important;}
		.dirlink { display: block; height: 100%; width: 100%; font: bold 12pt Verdana, Arial, Helvetica, sans-serif; text-decoration:none; text-align: center; margin: 0px; padding: 3px;}
	</style>

	<script type="text/javascript" src="../prototype.js" ></script>
	<script type="text/javascript">
		var arTiles = [ 
				{ src: "images/blank.png", name: "blank", crossable:'000' },
				{ src: "images/dirt.png", name: "dirt", crossable:1 },
				{ src: "images/grass.png", name: "grass", crossable:1 },
				{ src: "images/water.png", name: "water", crossable:3 }
			];

		function checkMapSize(){
			newmap = false;
			if( !parseInt( $F( "fldTileHeight" ) ) >= 1 ) $( "fldTileHeight" ).value = 0;
			if( !parseInt( $F( "fldTileWidth" ) ) >= 1 ) $( "fldTileWidth" ).value = 0;
			if( !parseInt( $F( "fldMapHeight" ) ) >= 1 ) $( "fldMapHeight" ).value = 0;
			if( !parseInt( $F( "fldMapWidth" ) ) >= 1 ) $( "fldMapWidth" ).value = 0;
			
			tH = parseInt( $F( "fldTileHeight" ) );
			tW = parseInt( $F( "fldTileWidth" ) );
			mH = parseInt( $F( "fldMapHeight" ) );
			mW = parseInt( $F( "fldMapWidth" ) );

			if( tH > 0 && tW > 0 && mW > 0 && mH > 0 ){
				if( typeof( map ) == 'undefined' || map.tW != tW || map.tH != tH || map.mW != mW || map.mH != mH  ){
	
					if( typeof( mapSize ) == 'undefined' ) {
						map = new Object;
						map.div = document.createElement('div');
						map.div.className = "boardDiv";
						map.div.style.width = map.tW * map.mW + "px";
						map.div.style.height = map.tH * map.mH + "px";
						newmap = true;
					}
					map.tW = tW;
					map.tH = tH;
					map.mW = mW;
					map.mH = mH;
	
					for( var cix=0; cix<map.mW; cix++ ){
						var colDiv = document.createElement('div');
						colDiv.className = "columnDiv";
						colDiv.style.height = map.tH * map.tH + "px";
						colDiv.style.width = map.tW + "px";
						colDiv.style.left = map.tW * cix + "px";
						
						for( var tix=0; tix<map.mH; tix++ ) {
							tile = document.createElement('div');
							tile.className = "tileDiv";
							tile.style.width = map.tW + "px";
							tile.style.height = map.tH + "px";
				
							var divImage = document.createElement('img');
							divImage.className = "tileImage";
				
							var divLink = document.createElement('a');
							divLink.className = "tileLink";
				
							tile.appendChild( divImage );
							tile.appendChild( divLink );

							colDiv.appendChild( tile );
							colDiv.lastChild.style.top = map.tH * tix + "px";
							colDiv.lastChild.id = cix + "_" + tix;
						}
						map.div.appendChild( colDiv );
					}
					for( rix=0; rix<$('mapDiv').childNodes.length; rix++ ) $( 'mapDiv' ).removeChild( $( 'mapDiv' ).childNodes[rix] );
					$( 'mapDiv' ).appendChild( map.div );
					for( div in $$( '.tileDiv' ) ) Event.observe( $$( '.tileDiv' )[ div ], "click", setMe );
				}
			}
		}
		
		function setMe( ){

		}

		function loadTiles(){
			for( ixTile=0; ixTile < arTiles.length; ixTile++ ){
				target = $( 'tileRows' );
				target.appendChild( document.createElement('tr') );
				for( ixCol=0; ixCol < 5; ixCol++) target.rows[ixTile].appendChild( document.createElement('td') );
				
				target.rows[ixTile].cells[0].innerHTML = ixCol;
				target.rows[ixTile].cells[1].appendChild( document.createElement('img') );
				target.rows[ixTile].cells[1].lastChild.src = arTiles[ ixTile ].src;
				target.rows[ixTile].cells[2].innerHTML = arTiles[ ixTile ].name;
				target.rows[ixTile].cells[3].innerHTML = arTiles[ ixTile ].src;
				target.rows[ixTile].cells[4].innerHTML = arTiles[ ixTile ].crossable;
			}
		}
		
		Event.observe( window, 'load', loadTiles );
	</script>
</head>

<body>
	<table>
		<tr>
			<td>
				<table>
					<thead>
						<tr>
							<td>Type</td>
							<td>Image</td>
							<td>Name</td>
							<td>Image URL</td>
							<td>Crossable</td>
						</tr>
					</thead>
					<tbody id="tileRows">
					</tbody>
				</table>
			</td>
			<td>
				<label>Tile Height: <input id="fldTileHeight" type="text" maxlength="3" onblur="checkMapSize();" /> (in pixels)</label><br />
				<label>Tile Width: <input id="fldTileWidth" type="text" maxlength="3" onblur="checkMapSize();" /> (in pixels)</label><br />
				<label>Map Height: <input id="fldMapHeight" type="text" maxlength="3" onblur="checkMapSize();" /> (in tiles)</label><br />
				<label>Map Width: <input id="fldMapWidth" type="text" maxlength="3" onblur="checkMapSize();" /> (in tiles)</label><br />
				<div style="border: 1px solid blue;" ><div style="background-color:#CCCCCC; color:#666666;">Add Image:</div>
					<!-- ID (index) | Name | URL -->
					<label>Name: <input id="fldImageAddName" type="text" maxlength="25" /></label><br />
					<label>URL: <input id="fldImageAddName" type="text" maxlength="25" /></label><br />
					Crossable By...
					<input type="checkbox" class="crossable" value="1" onchange="getCrossable();" />Land Units
					<input type="checkbox" class="crossable" value="2" onchange="getCrossable();" />Forest Units
					<input type="checkbox" class="crossable" value="4" onchange="getCrossable();" />Mountain Units
					<input type="checkbox" class="crossable" value="8" onchange="getCrossable();" />Air Units
					<input type="checkbox" class="crossable" value="16" onchange="getCrossable();" />Sea Units
					<input type="checkbox" class="crossable" value="32" onchange="getCrossable();" />Sea Units Can Launch
					<input type="checkbox" class="crossable" value="64" onchange="getCrossable();" />Air Units Slowed
					<input type="checkbox" class="crossable" value="128" onchange="getCrossable();" />Air Units Restricted
					<script>
						function getCrossable() {
							checkValue =0;
							for( ix=0;ix<$$( '.crossable' ).length;ix++ ) checkValue += $F( $$( '.crossable' )[ix] );
							alert( checkValue );
						}
					</script>
					<br />
				</div>
			</td>
			<td>
				Current Tile:<br />
				<!-- ID (index) | Name | URL -->
				<img id="currentImage" src="" /><br />
				<label>Tile Type ID: <input id="fldImageAddName" type="text" maxlength="2" /></label>
				<label>Tile Type Name: <input id="fldImageAddName" type="text" maxlength="2" /></label>
				<label>Tile Type Image URL: <input id="fldImageAddName" type="text" maxlength="2" /></label>
				<label>Tile Type Crossable: <input id="fldImageAddName" type="text" maxlength="2" /></label>
			</td>
		</tr>
		<tr>
			<td>
				<div id="mapDiv"></div>
			</td>
		</tr>
	</table>
</body>
</html>
