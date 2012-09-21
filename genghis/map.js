function genghis(){
	//SET UP PASS CONSTANTS:
	NONE = 0;//000
	WATER = 1;//001
	LAND = 2;//010
	WATER_LAND = 3;//011
	AIR = 4; //100
	WATER_AIR = 5;//101
	LAND_AIR = 6;//110
	WATER_LAND_AIR = 7;//111

	//		07 08 09      14               		NW NN NE      PN
	//		04 05 06   10 11 12 13  00          WW CC EE   PW PC PH PE  FL
	//		01 02 03      15                    SW SS SE      PV
	//		              16                                  PS
	//      Border Positions:
	//		112 241 193       064             
	//		124 255 199   016 085 017 001  000
	//		028 031 007       068             
	//		                  004             
	this.tilePositions = [ 'FL','SW','SS','SE','WW','CC','EE','NW','NN','NE','PW','PC','PH','PE','PN','PV','PS' ];
	/* 17 Tile Set */
//			this.borderPositions = [
//				/* 00 */[0,2,8,10,32,34,40,128,130,136,160],
//				/* 01 */[28],
//				/* 02 */[31],
//				/* 03 */[7],
//				/* 04 */[124,254],
//				/* 05 */[255],
//				/* 06 */[199],
//				/* 07 */[112],
//				/* 08 */[113,209,241],
//				/* 09 */[193],
//				/* 10 */[16,24,40,48],
//				/* 11 */[85],
//				/* 12 */[17],
//				/* 13 */[1,3,129,131],
//				/* 14 */[64],
//				/* 15 */[68],
//				/* 16 */[4]
//			];
	/* 9 Tile Set */
	this.borderPositions = [
		/* 00 */[  0,  2,  8, 10, 32, 34, 40,128,130,136,160],
		/* 01 */[ 20, 22, 30, 62,158, 54,182,150, 28, 60,188,156, 52,180,148],
		/* 02 */[ 21, 23, 31, 63,159, 55,183,151, 29, 61,189,157, 53,181,149],
		/* 03 */[  5,  7, 15, 47,143, 39,167,135, 13, 45,173,141, 37,165,133],
		/* 04 */[ 84, 86, 94,126,222,118,246,214, 92,124,252,220,116,244,212],
		/* 05 */[255, 85, 87, 93, 95,117,119,125,155,211,213,215,241,245,247],
		/* 06 */[ 69, 71, 79,111,207,103,231,199, 77,109,237,205,101,229,197],
		/* 07 */[ 80, 82, 90,122,218,114,242,210, 88,120,248,216,112,240,208],
		/* 08 */[ 81, 83, 91,123,219,115,243,211, 89,121,249,217,113,241,209],
		/* 09 */[ 65, 67, 75,107,203, 99,227,195, 73,105,233,201, 97,225,193],
		/* 10+*/[],[],[],[],[],[],[]
	];

	this.tileType = function( inVars ){
		if( typeof inVars.path == 'undefined' && typeof this.imagePath == 'string' ) inVars.path = this.imagePath;

		if( typeof inVars.base == 'undefined' ) inVars.base = false;

		var tileObject={ pass: inVars.pass, base: inVars.base, positions:[ 'FL','SW','SS','SE','WW','CC','EE','NW','NN','NE','PW','PC','PH','PE','PN','PV','PS' ] };
		posSet=[];
		if( typeof inVars.positions == 'number' ) for( var lix=0; lix<=inVars.positions; lix++ ) posSet.push( lix );
		if( typeof inVars.positions == 'string' ) posSet=inVars.positions.split(',');

		//Convert Code Letter Names to Integer Values
		for( var fix=0; fix<posSet.length; fix++) for( var pix=0; pix<=16; pix++ ) if( posSet[fix] == this.tilePositions[ pix ]) posSet[fix] == pix;

		//Build tileObject
		for( pix=0; pix<=16; pix++ ) for( fix=0; fix<posSet.length; fix++) {
			if( posSet[fix] == pix ){
				tileObject.positions[ pix ] = document.createElement( 'img' ) ;
				tileObject.positions[ pix ].src = inVars.path + inVars.name + "_" + pix.toPaddedString(2) +".png";
				tileObject.positions[ pix ].className = "terrain";
				tileObject.positions[ pix ].style.width = inVars.width + "px";
				tileObject.positions[ pix ].style.height = inVars.height + "px";
			}
		}
		return tileObject;
	}


	this.tileInit = function( tHeight, tWidth ){
		var tile = new Object();
		tile.div = document.createElement('div');
		tile.div.className = "tileDiv";
		tile.div.style.width = tWidth + "px";
		tile.div.style.height = tHeight + "px";
		return tile.div;
	}
	this.viewInit = function( vWidth, vHeight, tWidth, tHeight ) {
		var viewObject = new Object;
		viewObject.isReady = false;

		viewObject.width = vWidth;
		viewObject.height = vHeight;
		viewObject.columns = tWidth;
		viewObject.rows = tHeight;
		viewObject.div = document.createElement('div');
		viewObject.div.className = "boardDiv";
		viewObject.div.style.width = tWidth * vWidth + "px";
		viewObject.div.style.height = tHeight * vHeight + "px";

		viewObject.cLabels=['a','b'];
		for( vwix=0; vwix<vWidth; vwix++) viewObject.cLabels.push( viewObject.cLabels.length.toString() );
		viewObject.cLabels.push('y','z');
		viewObject.rLabels=['a','b'];
		for( vix=0; vix<vHeight; vix++) viewObject.rLabels.push( viewObject.rLabels.length.toString() );
		viewObject.rLabels.push('y','z');

		for( var cix=0; cix<vWidth+4; cix++ ){
			vcix = viewObject.cLabels[ cix ];
			var colDiv = document.createElement('div');
			colDiv.className = "columnDiv";
			colDiv.style.height = tHeight * vHeight + "px";
			colDiv.style.width = tWidth + "px";
			colDiv.style.left = tWidth * cix + "px";

			for( var tix=0; tix<vHeight+4; tix++ ) {
				vtix = viewObject.rLabels[ tix ];
				//build frame DIV
				colDiv.appendChild( this.tileInit( tWidth, tHeight ) );
				tileDiv = colDiv.lastChild;
				tileDiv.style.top = tHeight * tix + "px";
				tileDiv.id = vcix + "_" + vtix;

				//build base IMG
				baseImage = document.createElement('img');
				baseImage.id = "base_" + vcix + "_" + vtix;
				baseImage.className = "base";

				//build terrain IMG
				terrainImage = document.createElement('img');
				terrainImage.id = "terrain_" + vcix + "_" + vtix;
				terrainImage.className = "terrain";

				//build text layer div
				textDiv = document.createElement('div');
				textDiv.id = "text_" + vcix + "_" + vtix;
				textDiv.className = "text";

				tileDiv.appendChild( baseImage );
				tileDiv.appendChild( terrainImage );
				tileDiv.appendChild( textDiv );
			}
			viewObject.div.appendChild( colDiv );
		}
		return viewObject;
	}

	this.moveView = function( ){
		if( arguments.length <= 0 && arguments.length >= 5 ){
			alert( "Genghis.moveView takes 0 to 4 arguments:\nmoveView( [map],[viewport],(s|se|sw|w|e|n|nw|ne)\nmoveView( [map],[viewport],[toX,toY]\n* map and viewport default to genghis.maps[0] and genghis.views[0]\n* toX,toY represent locations on map move to in one step\n* toX,toY default to the map's initx and inity" );
			return false;
		} else {
			if( typeof arguments[ arguments.length - 1 ] == 'string' ){
				argCount=arguments.length-1;
				targetMap = this.maps[ 0 ];
				targetView = this.views[ 0 ];
				if( argCount == 1 ) {
					if( typeof arguments[0] == 'number' ) targetMap = this.maps[ arguments[0] ];
					else if( typeof arguments[0] == 'object' ) targetMap = arguments[0];
				} else if( argCount == 2 ) {
					if( typeof arguments[0] == 'number' ) targetMap = this.maps[ arguments[1] ];
					else if( typeof arguments[0] == 'object' ) targetMap = arguments[1];
				}
				if( arguments[arguments.length - 1].toLowerCase().search( /(s|se|sw)/ ) == 0 ) targetY = targetMap.currentY + 1;
				if( arguments[arguments.length - 1].toLowerCase().search( /(n|ne|nw)/ ) == 0 ) targetY = targetMap.currentY - 1;
				if( arguments[arguments.length - 1].toLowerCase().search( /(e|ne|se)/ ) == 0 ) targetX = targetMap.currentX + 1;
				if( arguments[arguments.length - 1].toLowerCase().search( /(w|nw|sw)/ ) == 0 ) targetX = targetMap.currentX - 1;
			}else if( arguments.length == 1 && ( typeof arguments[ 0 ] == 'object' || typeof arguments[ 0 ] == 'number' ) ){
				if( typeof arguments[ 0 ] == 'number' ) targetMap = this.maps[ arguments[ 0 ] ];
				else targetMap = arguments[ 0 ];
				targetView = this.views[ 0 ];
				targetX = targetMap.initX;
				targetY = targetMap.initY;
			}else if( arguments.length >= 2 && typeof arguments[ arguments.length - 1 ] == 'number' && typeof arguments[ arguments.length - 2 ] == 'number' ){
				argCount=arguments.length-2;
				targetMap = this.maps[ 0 ];
				targetView = this.views[ 0 ];
				if( argCount == 1 ) {
					if( typeof arguments[0] == 'number' ) targetMap = this.maps[ arguments[0] ];
					else if( typeof arguments[0] == 'object' ) targetMap = arguments[0];
				} else if( argCount == 2 ) {
					if( typeof arguments[0] == 'number' ) targetMap = this.maps[ arguments[1] ];
					else if( typeof arguments[0] == 'object' ) targetMap = arguments[1];
				}
				targetX = arguments[arguments.length - 1];
				targetY = arguments[arguments.length - 2];
				argCount=arguments.length-2;
			} else if(arguments.length == 0){
				targetMap = this.maps[ 0 ];
				targetView = this.views[ 0 ];
				targetX = targetMap.initX;
				targetY = targetMap.initY;
			} else {
				alert( "Wrong Options:\n" + typeof arguments[0] + "\n" + typeof arguments[1] + "\n" + typeof arguments[2] + "\n" + typeof arguments[3]  );
				return false;
			}
		}

		//abandon proc if already in motion
		if( typeof targetView.isMoving == 'undefined' ) targetView.isMoving = true;
		else if( targetView.isMoving ) return false;

		targetWidth = targetMap.layout.length;
		targetHeight = targetMap.layout[0].length;

		if( targetX + targetMap.currentX > targetMap.width ) targetX = targetMap.width - targetView.width;
		if( targetY + targetMap.currentY > targetMap.height ) targetY = targetMap.height - targetView.height;
		if( targetX < 0 ) targetX = 0;
		if( targetY < 0 ) targetY = 0;

		if( Math.abs(currentX-targetX) > 1 || Math.abs(currentY-targetY) > 1 ){
		/* OLD WAY - REMAP EVERY PICTURE - USE FOR RELOCATIONS (vs MOVES) */
			if( typeof targetMap.currentX == 'undefined' || targetMap.currentX != targetX || targetMap.currentY != targetY ){
				for( var cix=0; cix < targetView.width; cix++) for( var tix=0; tix < targetView.height; tix++){
					ttix = tix+targetY;
					ctix = cix+targetX;
					thisTileType = targetMap.layout[ctix][ttix] ;
					thisTilePos = 'CC';
					thisViewTile = targetView.div.childNodes[ cix ].childNodes[ tix ];
					
					//if( this.tiles[ thisTileType ].base && $( "base_" + cix + "_" + tix ).src != this.tiles[ this.tiles[ thisTileType ].base ].positions[ 5 ].src )
					if( this.tiles[ thisTileType ].base ){
						if( $( "base_" + cix + "_" + tix ).src = this.tiles[ this.tiles[ thisTileType ].base ].positions[ 5 ].src )
							$( "base_" + cix + "_" + tix ).src = this.tiles[ this.tiles[ thisTileType ].base ].positions[ 5 ].src;
					}
					if( $( "terrain_" + cix + "_" + tix ).src != this.tiles[ thisTileType ].positions[ thisTilePos ].src )
						$( "terrain_" + cix + "_" + tix ).src = this.tiles[ thisTileType ].positions[ thisTilePos ].src;
					//$( "text_" + cix + "_" + tix ).innerHTML = targetMap.layout[ctix][ttix][2] + "\n" + thisTilePos;
				}
				targetMap.currentX = targetX;
				targetMap.currentY = targetY;
			}
		} else if( Math.abs(currentX-targetX) + Math.abs(currentY-targetY) == 1 || Math.abs(currentX-targetX) + Math.abs(currentY-targetY) == 2 ){
		/* NEW WAY - MOVE VISIBLE TILES, RENAME EDGES */

			

		} else {
		}
		targetView.isMoving = false;
	}

	this.loadView = function(){
		if( arguments.length == 1 ) {
			appendToDiv = $( arguments[0] );
			appendToChild = this.views[0];
		} else if( arguments.length == 2 ) {
			appendToDiv = $( arguments[0] );
			appendToChild = this.views[ arguments[1] ];
		} else {
			appendToDiv = document.body;
			appendToChild = this.views[0];
		}
		appendToDiv.appendChild( appendToChild.div );
		return true;
	}

/* BUILDMAP */

	this.buildmap = function( mapOb ){
		mapOb.height = mapOb.layout.length;
		mapOb.width = mapOb.layout[0].length;
		newLayout=new Array( mapOb.height );
		for( mrix=0; mrix < mapOb.height; mrix++) {
			newLayout[ mrix ] = new Array( mapOb.width );
			for( mcix=0; mcix < mapOb.width; mcix++){
				//Find the right tile border position: Check cardinal neighbors for matchings, pick position based on that.
				posCalc=0;
				thisTileType = mapOb.layout[mrix][mcix];
				thisTilePos = 5;
				if( this.tiles[ thisTileType ].base ){
					if( mcix == 0 || mapOb.layout[mrix][mcix-1] == thisTileType ) posCalc+=4;
					if( mcix == 0 || mrix == 0 || mapOb.layout[mrix-1][mcix-1] == thisTileType ) posCalc+=2;//a
					if( mrix == 0 || mapOb.layout[mrix-1][mcix] == thisTileType ) posCalc+=1;//b
					if( mcix == mapOb.width-1 || mrix == 0 || mapOb.layout[mrix-1][mcix+1] == thisTileType ) posCalc+=128;//c
					if( mcix == mapOb.width-1 || mapOb.layout[mrix][mcix+1] == thisTileType ) posCalc+=64;
					if( mcix == mapOb.width-1 || mrix == mapOb.height-1 || mapOb.layout[mrix+1][mcix+1] == thisTileType ) posCalc+=32;
					if( mrix == mapOb.height-1 || mapOb.layout[mrix+1][mcix] == thisTileType ) posCalc+=16;
					if( mcix == 0 || mrix == mapOb.height-1 || mapOb.layout[mrix+1][mcix-1] == thisTileType ) posCalc+=8;

					//Convert Binary Border Value To Integer Tile Position
					for( var pix=0; pix<=16; pix++ ){
						for( var vix=0; vix<this.borderPositions[ pix ].length; vix++ ) {
							if( posCalc == this.borderPositions[ pix ][vix]) thisTilePos = pix;
						}
					}
				} 
				newLayout[ mrix ][ mcix ] = [ mapOb.layout[ mrix ][ mcix ], thisTilePos, posCalc ];

				thisTileType = mapOb.layout[mrix][mcix];
				thisTilePos = "CC";

				//build base IMG
				baseImage = document.createElement('img');
				baseImage.id = "base_" + mcix + "_" + mrix;
				baseImage.style.top = mapOb.tileHeight * mapOb.height + "px";
				baseImage.style.left = mapOb.tileWidth * mapOb.width + "px";
				baseImage.className = "base";
				if( window.console.log( this ) && this.tiles[ thisTileType ].base ){
					baseImage.src = this.tiles[ this.tiles[ thisTileType ].base ].positions[ 5 ].src;
				}

				//build terrain IMG
				terrainImage = document.createElement('img');
				terrainImage.id = "terrain_" + mcix + "_" + mrix;
				terrainImage.style.top = mapOb.tileHeight * mapOb.height + "px";
				terrainImage.style.left = mapOb.tileWidth * mapOb.width + "px";
				terrainImage.className = "terrain";
				terrainImage.src = this.tiles[ thisTileType ].positions[ thisTilePos ].src;

				//build text layer div
				textDiv = document.createElement('div');
				textDiv.id = "text_" + mcix + "_" + mrix;
				textDiv.style.top = mapOb.tileHeight * mapOb.height + "px";
				textDiv.style.left = mapOb.tileWidth * mapOb.width + "px";
				textDiv.className = "text";

				mapOb.div.appendChild( baseImage );
				mapOb.div.appendChild( terrainImage );
				mapOb.div.appendChild( textDiv );

/* BUILD MAP */




			}
		}
		mapOb.layout = newLayout;

		mapOb.div = document.createElement('div');
		for( mrix=0; mrix < mapOb.height; mrix++) {
			for( mcix=0; mcix < mapOb.width; mcix++){

			}
		}
		$( 'test' ).appendChild( mapOb );
		this.maps.push( mapOb );
		this.moveView( this.maps[ this.maps.length-1 ] );
	}

	//New Genghis Instance Init Functions and Vars
	this.maps=[];
	this.views=[];
	if( arguments.length == 1 && typeof( arguments[0] ) == 'object' ) {
		this.views[0] = this.viewInit( arguments[0].vWidth, arguments[0].vHeight, arguments[0].tWidth, arguments[0].tHeight );
		if( typeof( arguments[0].imagePath ) == 'string' ) this.imagePath = arguments[0].imagePath;
	} else if( arguments.length == 1 && typeof( arguments[0] ) == 'string' ) {
		this.views[0] = this.viewInit( 10,10,32,32 );
	} else if( arguments.length >= 4 ) {
		this.views[0] = this.viewInit( arguments[0],arguments[1],arguments[2],arguments[3] );
		if( typeof arguments.length == 5 && typeof arguments[4] == 'string' ) this.imagePath = arguments.imagePath;
	}
}

tG = new genghis( { vWidth: 7, vHeight: 7, tWidth: 24, tHeight: 24, imagePath:'http://introprod.com/samples/genghis/images/' } );

tG.tiles = {
	blank : tG.tileType( { height: 24, width:24, name: 'blank', positions: "5", pass: tG.NONE } ),
	dirt : tG.tileType( { height: 24, width:24, name: 'dirt', positions: "5", pass: tG.WATER_LAND_AIR } ),
	path : tG.tileType( { height: 24, width:24, name: 'path', base: 'dirt', positions: 9, pass: tG.LAND_AIR } )
};

testmap = {
	name: "testmap",
	targetBoard: "",
	initX: 0,
	initY: 0,
	layout: [
		[ 'dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt' ],
		[ 'dirt','path','dirt','path','path','path','path','path','path','path','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt' ],
		[ 'dirt','path','path','path','path','path','path','path','path','path','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt' ],
		[ 'dirt','path','path','path','path','path','path','path','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt' ],
		[ 'dirt','path','path','path','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt' ],
		[ 'dirt','path','dirt','dirt','dirt','path','path','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','path','path','dirt','dirt','path','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt' ],
		[ 'dirt','dirt','dirt','dirt','dirt','path','path','path','dirt','dirt','dirt','dirt','dirt','dirt','path','path','path','path','path','path','path','path','path','path','path','path','path','path','dirt','path' ],
		[ 'dirt','dirt','dirt','dirt','dirt','dirt','path','dirt','dirt','dirt','dirt','dirt','dirt','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path' ],
		[ 'dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path' ],
		[ 'dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path' ],
		[ 'dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','dirt','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path' ],
		[ 'dirt','dirt','dirt','dirt','dirt','dirt','dirt','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path' ],
		[ 'dirt','dirt','dirt','dirt','dirt','dirt','path','path','path','path','path','path','path','dirt','dirt','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path' ],
		[ 'dirt','dirt','dirt','dirt','dirt','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path' ],
		[ 'dirt','dirt','dirt','dirt','dirt','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path' ],
		[ 'dirt','dirt','dirt','dirt','dirt','dirt','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path' ],
		[ 'dirt','dirt','dirt','dirt','dirt','dirt','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path' ],
		[ 'dirt','dirt','dirt','dirt','dirt','dirt','dirt','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path','path' ]
	]
};

