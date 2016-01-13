function decToHex( inDec ) {
	outHex = ( inDec ).toString(16);
	if( outHex.length==1 ) outHex= "0" + outHex;
	return outHex;
}

function hexToDec(inHex) {
	inHex.replace(/^#/,"")
	return parseInt( inHex, 16 );
}

var currentX = 100;
var currentY = 100;
var mouseAway = false;
var particles = [];
var currentX = 0;
var currentY = 0;
var particleStyles = ({
	smoke : { count:40, spawnrate:3, width: 9, height: 9, decay: 50, decayVariance: 1, birthVariance: .5, hSpeed: 1, cohesion: 0, ball: 0, vSpeed: -1, vSpeedVariance: 1, color: ['#000000', '#FFFFFF', '#FFFFFF'], opacity: [20, 20, 0], shape: [ [ 1 ] ] },
	purpleHaze : { count:30, spawnrate:1, width: 5, height: 5, scale: [ 1, 2, 3 ], decay: 50, decayVariance: 1, birthVariance: 0, hSpeed: 1, hSpeedVariance: 1, cohesion: 1, ball: 0, vSpeed: 1, vSpeedVariance: 1, color: ['#550055', '#FF00BB', '#FFBBDD', '#DDBBFF', '#FF00BB', '#FFDDFF'], opacity: [20, 50, 50, 0], shape: [ [ 0, 1, 0 ], [1, 1, 1], [1, 1, 1], [0, 1, 0] ] },
	bigLighter : { count:40, spawnrate:5, width: 6, height: 6, decay: 20, decayVariance: .5, birthVariance: .1, hSpeed: 3, cohesion: .5, ball: 1, vSpeed: -4, vSpeedVariance: 0, color: ['#0000FF','#FFFFAA','#FFFF00','#FF0000','#FF0000','#FF0000'], opacity: [50, 75, 75, 75, 0], shape: [ [ 0, 1, 0 ], [1, 1, 1], [1, 1, 1], [0, 1, 0] ] },
	smallLighter : { count:40, spawnrate:3, width: 4, height: 4, decay: 15, decayVariance: 0, birthVariance: .1, hSpeed: 2, cohesion: .5, ball: 1, vSpeed: -3, vSpeedVariance: 0, color: ['#0000FF','#FFFFAA','#FFFF00','#FF0000','#FF0000','#FF0000'], opacity: [50, 75, 75, 75, 0], shape: [ [ 0, 1, 0 ], [1, 1, 1], [1, 1, 1], [0, 1, 0] ] },
	squareLighter : { count:40, spawnrate:3, width: 4, height: 4, decay: 10, decayVariance: 0, birthVariance: .1, hSpeed: 3, cohesion: .7, ball: 1, vSpeed: -3, vSpeedVariance: 0, color: ['#0000FF','#FFFFAA','#FFFF00','#FF0000','#FF0000','#FF0000'], opacity: [50, 75, 75, 75, 0], shape: [ [ 1 ] ] },
	flame : { count:40, width: 4, height: 7, decay: 20, decayVariance: 2, birthVariance: .3, hSpeed: 7, cohesion: .5, ball: 1, hspeed: 2, hspeedVariance: .5, color: ['#FFFF00','#FF0000'], opacity: [50, 75, 75, 0] }
})

$(
	$( document ).mousemove(function( event ) {
		currentX = event.pageX;
		currentY = event.pageY;
	})
);

function unbuildParticles( ){
	for( var ix=0; ix < particles.length; ix++ ){
		particles[ix].div =  $( "#particle_" + ix ).remove();
	}
	particles = new Array(1);
}

function addParticle( pStyle ){
	if( typeof( particles[0] ) == 'undefined' ) ix = 0;
	else ix = particles.length;
	particles[ix] = new Object();
	particles[ix].style = pStyle;
	particles[ix].birthX = '-10';
	particles[ix].birthY =  '-10';
	particles[ix].age = Math.ceil( Math.random() * particleStyles[ pStyle ].decay );

	particles[ix].div = document.createElement('div');
	particles[ix].div.name = "particle_" + ix;
	particles[ix].div.id = "particle_" + ix ;
	particles[ix].div.style.display = "block";
	particles[ix].div.style.position = "absolute";
	particles[ix].div.style.margin = "0px";
	particles[ix].div.style.padding = "0px";
	particles[ix].div.style.border = "none";
	particles[ix].div.style.font = "1px Verdana;";

	particles[ix].div.style.top = '-10px';
	particles[ix].div.style.left =  '-10px';
	particles[ix].div.style.width = '5px';
	particles[ix].div.style.height = '5px';

	particles[ix].div.innerHTML = '';
	for( ixA = 1; ixA <= particleStyles[ pStyle ].shape.length; ixA++ ){
		for( ixB = 1; ixB <= particleStyles[ pStyle ].shape[ixA-1].length; ixB++ ){
			if( particleStyles[ pStyle ].shape[ixA-1][ixB-1] )particles[ix].div.innerHTML += '<div style="display:block;float:left;width:' + 100/particleStyles[ pStyle ].shape[ixA-1].length + '%; height:' + 100/particleStyles[ pStyle ].shape.length + '%; margin:0; padding:0;" id="' + ix + 'd' + ixA + ixB + '"></div>';
			else particles[ix].div.innerHTML += '<div style="display:block;float:left;width:' + 100/particleStyles[ pStyle ].shape[ixA-1].length + '%; height:' + 100/particleStyles[ pStyle ].shape.length + '%; margin:0; padding:0;" id="' + ix + 'd' + ixA + ixB + '"></div>';
		}
	}

	particles[ix].div.style.opacity = opacityCheck( particleStyles[ pStyle ], 1 )/100;
	particles[ix].div.style.filter = 'alpha(opacity=' + opacityCheck( particleStyles[ pStyle ], 1 ) +')';

	document.body.appendChild( particles[ix].div );
}

function buildParticles( pStyle ){
	if( typeof( animated ) != 'undefined' ) window.clearTimeout( animated );
	if( particles.length > 1 ) unbuildParticles();
	else{
		addParticle( pStyle );

		startMS = ( new Date() ).getTime();
		endMS = startMS;
		loop =0;
		avgMS = 0;

		//start animation
		animateParticles();
	}
}

function animateParticles(){
	hasCreated = 0;

	//Get Runtime in Milliseconds...
	loop ++;
	avgMS = Math.round( ( ( endMS - startMS) + avgMS * ( loop - 1 ) ) / loop );
	startMS = endMS; endMS = ( new Date() ).getTime();

	pS = particleStyles[ particles[0].style ];
	for( var ix=0; ix < pS.count; ix++ ){
		tP = particles[ix];
		if( hasCreated < pS.spawnrate && ( typeof( tP ) == 'undefined' || tP.age >= pS.decay || parseInt(tP.div.style.top) <= -10 ) ){
			if( typeof( particles[ix] ) == 'undefined' ) addParticle( particles[0].style );
			tP = particles[ix];

			tP.div.style.height = tP.div.style.height;
			tP.div.style.width = tP.div.style.width;

			tP.age = 4;//Math.ceil( Math.random() * pS.decay * pS.birthVariance );

			tP.decay = 1 + ( Math.random() * pS.decayVariance * 2) - pS.decayVariance  ;
			tP.vSpeed = pS.vSpeed - Math.round( Math.random() * pS.vSpeed * pS.vSpeedVariance *10 ) / 10
			tP.hSpeed = Math.round( Math.random() * pS.hSpeed * ( ( Math.round( Math.random() ) ) && 1 || -1 ) * 10 ) / 10;

			tP.birthX = (currentX + tP.hSpeed - ( pS.width / 2 ));
			tP.birthY = currentY - pS.height-5;/* Putting Fire Ball ON TOP of cursor to avoid clickfail */
			
			/*
			Move birthplace out of the way of the cursor.
			!Fail : For Now we will reposition
			if( tP.birthX == currentX ) tP.birthX+=tP.div.style.width;
			if( tP.birthY == currentY ) tP.birthY+=tP.div.style.height;
			if( tP.birthX >= currentX-tP.div.style.width && tP.birthX < currentX ) tP.birthX-=tP.div.style.width;
			if( tP.birthY == currentY-tP.div.style.height && tP.birthY < currentY ) tP.birthY-=tP.div.style.height;
			*/
			
			tP.div.style.left = tP.birthX + "px";
			tP.div.style.top = tP.birthY + "px";
			hasCreated++;
		} else if ( typeof( tP ) != 'undefined' && tP.age < pS.decay ){

			//Move Particle Naturally
			tP.div.style.left = tP.div.offsetLeft + tP.hSpeed + "px";
			tP.div.style.top = tP.div.offsetTop + tP.vSpeed + "px";

			//Adjust For Cohesion
			tP.div.style.left = tP.div.offsetLeft + Math.round( ( tP.birthX - tP.div.offsetLeft ) * ( tP.age / pS.decay * pS.cohesion ) * 10 ) / 10 + "px";

			/* Relocate if the particle is in the way of the cursor
			if( parseInt(tP.div.style.left) == currentX ) tP.div.style.left+=15;
			if( parseInt(tP.div.style.top) == currentY ) tP.div.style.top+=15;
			if( parseInt(tP.div.style.left) >= currentX-parseInt(tP.style.width) && parseInt(tP.div.style.left) < currentX ) tP.div.style.left-=15;//(tP.style.width+2);
			if( parseInt(tP.div.style.top) >= currentY-parseInt(tP.style.height) && parseInt(tP.div.style.top) < currentY ) tP.div.style.top-=15;//(tP.style.height+2);
			*/

			thisBallAge = virtAge(tP);
			
			tP.div.style.zIndex = 100 + thisBallAge;

			//sizeNow = sizeCheck( pS, parseInt(thisBallAge) );
			colorNow = colorCheck( pS, parseInt(thisBallAge) );
			opacityNow = opacityCheck( pS, thisBallAge );
			for( ixA = 1; ixA <= pS.shape.length; ixA++ ){
				for( ixB = 1; ixB <= pS.shape[ixA-1].length; ixB++ ){
					if( pS.shape[ixA-1][ixB-1] ){
						$( '#' + ix + 'd' + ixA + ixB ).css( "background-color", colorNow );
					}
				}
			}

			// !!sizeCheck disabled !!
			// !!sizeCheck disabled !!
			$(tP.div).fadeTo( opacityNow/100 );
			tP.age = tP.age + tP.decay;
		}
	}
	animated = window.setTimeout( 'animateParticles()', 10 );
}

function virtAge( tP ){
	var pS = particleStyles[ tP.style ];
	if( pS.ball ) {
		var actAge = tP.age + Math.round( ( pS.decay + ( ( pS.decay - tP.age ) / 3 ) ) * ( Math.abs( parseInt(tP.birthX) - parseInt(tP.div.offsetLeft) ) / ( pS.hSpeed * 10 ) ) );
		if( actAge >= pS.decay ) actAge = pS.decay;
		else if( actAge < 1 ) actAge = 1;
	} else actAge = tP.age;
	return actAge
}

function sizeCheck( inPS, inAge ){
	var thisAge=inAge;
	var thisPS=inPS;
	stageLength = thisPS.decay / ( thisPS.scale.length - 1 );
	lastStage = thisPS.scale[ Math.floor( thisAge / stageLength ) ];
	nextStage = thisPS.scale[ Math.ceil( thisAge / stageLength ) ];
	stageStep = thisAge - ( Math.floor( thisAge / stageLength ) * stageLength );

	thisPS.style.width = particleStyles[ pStyle ].width + 'px';
	thisPS.style.height = particleStyles[ pStyle ].height + 'px';

	return Math.floor( lastStage + ( ( nextStage - lastStage ) / stageLength ) * stageStep ); 
}

function opacityCheck( inPS, inAge ){
	var thisAge=inAge;
	var thisPS=inPS;
	stageLength = thisPS.decay / ( thisPS.opacity.length - 1 );
	lastStage = thisPS.opacity[ Math.floor( thisAge / stageLength ) ];
	nextStage = thisPS.opacity[ Math.ceil( thisAge / stageLength ) ];
	stageStep = thisAge - ( Math.floor( thisAge / stageLength ) * stageLength );

	return Math.floor( lastStage + ( ( nextStage - lastStage ) / stageLength ) * stageStep ); 
}

function colorCheck( inPS, inAge ){

	var thisAge=inAge;
	var thisPS=inPS;


	stageLength = thisPS.decay / ( thisPS.color.length - 1 );
	outVars = { age : inAge, pS : inPS, lastStage : lastStage };
	lastStage = [ hexToDec( thisPS.color[ Math.floor( thisAge / stageLength ) ].substr( 1, 2 ) ), hexToDec( thisPS.color[ Math.floor( thisAge / stageLength ) ].substr( 3, 2 ) ), hexToDec( thisPS.color[ Math.floor( thisAge / stageLength ) ].substr( 5, 2 ) ) ];
	nextStage = [ hexToDec( thisPS.color[ Math.ceil( thisAge / stageLength ) ].substr( 1, 2 ) ), hexToDec( thisPS.color[ Math.ceil( thisAge / stageLength ) ].substr( 3, 2 ) ), hexToDec( thisPS.color[ Math.ceil( thisAge / stageLength ) ].substr( 5, 2 ) ) ];
	stageStep = thisAge - ( Math.floor( thisAge / stageLength ) * stageLength );

retVar = "#" + decToHex( Math.floor( lastStage[0] + ( ( nextStage[0] - lastStage[0] ) / stageLength ) * stageStep ) );
retVar += decToHex( Math.floor( lastStage[1] + ( ( nextStage[1] - lastStage[1] ) / stageLength ) * stageStep ) );
retVar += decToHex( Math.floor( lastStage[2] + ( ( nextStage[2] - lastStage[2] ) / stageLength ) * stageStep ) );

console.log( thisPS );

	return retVar
}
