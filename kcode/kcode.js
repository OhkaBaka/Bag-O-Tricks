	$(window).on('load', function() {
		//kcode.oneUp.build();
		kcode.keyCheck();
	});

	kcode = {
		keyseq: 0,
		keyCheck: function(){
			$(document).keydown(function(e) {
				if( kcode.keyseq ) console.log("K-Sequence Test", kcode.keyseq);
				if ( ( kcode.keyseq == 0 || kcode.keyseq == 1 ) && e.which==38 ) kcode.keyseq++;
				else if ( ( kcode.keyseq == 2 || kcode.keyseq == 3 ) && e.which==40 ) kcode.keyseq++;
				else if ( ( kcode.keyseq == 4 || kcode.keyseq == 6 ) && e.which==37 ) kcode.keyseq++;
				else if ( ( kcode.keyseq == 5 || kcode.keyseq == 7 ) && e.which==39 ) kcode.keyseq++;
				else if ( ( kcode.keyseq == 8 ) && e.which==66 ) kcode.keyseq++;
				else if ( ( kcode.keyseq == 9 ) && e.which==65 ) kcode.kEvent();
				else if ( e.which==38 ) kcode.keyseq=1;
				else {
					if( kcode.keyseq ) console.log("K-Sequence Broke");
					kcode.keyseq = 0;
				}
			});
		},
		kEvent: function() {
			this.oneUp.build();
			kcode.keyseq = 0;
		},
		oneUp: {
			init : false,
			build : function(){
				if( !this.init ){
					var style = $('<style>.kc_pixel { width:12px; height:12px; position:absolute; } .v_0 { border: 0px solid black; background-color:transparent; }.v_1 { border: 1px solid black; background-color:white; }</style>');
					$('html > head').append(style);
				}

				scale = 2-(Math.random()*2);
				startLeft = Math.floor( Math.random() * ( $(window).width() - (330 * scale) ) );
				startTop = Math.floor( Math.random() * $(window).height() );
				mainColor = [ Math.floor( Math.random() * 255 ), Math.floor( Math.random() * 255 ), Math.floor( Math.random() * 255 ) ];

				var container = $("<div class='kc_container'></div>");
				$('html > body').append(container);

				for( row in this.structure ){
					for( column in this.structure[row] ){
						if( this.structure[row][column] ) thisBGColor = "rgb(" + mainColor[0] + "," + mainColor[1] + "," + mainColor[2] + ")";
						else thisBGColor = "transparent";
						pixel = $( "<div class='kc_pixel r_" + row + " c_" + column + " v_" + ( this.structure[row][column] ) + "' style='top:" + ((row*15*scale)+startTop) + "px; left:"  + ((column*15*scale)+startLeft) + "px; transform: scale(" + scale + "," + scale + "); background-color:" + thisBGColor + ";'' data-accel='0'></div>" );
						$('html > body').append( pixel );
					}
				}
				kcode.oneUp.move();
			},
			structure : [[0,0,1,1,0,0,0,1,1,0,0,0,1,1,0,1,1,1,1,1,1,0],[0,1,1,1,0,0,0,1,1,0,0,0,1,1,0,1,1,0,0,0,1,1],[0,0,1,1,0,0,0,1,1,0,0,0,1,1,0,1,1,0,0,0,1,1],[0,0,1,1,0,0,0,1,1,0,0,0,1,1,0,1,1,0,0,0,1,1],[0,0,1,1,0,0,0,1,1,0,0,0,1,1,0,1,1,1,1,1,1,0],[0,0,1,1,0,0,0,1,1,0,0,0,1,1,0,1,1,0,0,0,0,0],[1,1,1,1,1,1,0,0,1,1,1,1,1,0,0,1,1,0,0,0,0,0]],
			move: function(){

				var needToMove=false;
				$('.kc_pixel').each(function(this_pixel){
					newAccel = $('.kc_pixel:eq(' + this_pixel + ')').data('accel') + 3;
					newTop = ( parseInt( $('.kc_pixel:eq(' + this_pixel + ')').css('top') ) - newAccel ) + "px";
					if( parseInt( newTop ) > -15 ) needToMove = true;
					$( '.kc_pixel:eq(' + this_pixel + ')' ).css( 'top', newTop ).data( 'accel', newAccel );
				});

				//Move the kcode message until it is off screen, then destroy it
				if( needToMove ) setTimeout( kcode.oneUp.move, 20 );
				else $('.kc_pixel').remove();
			}
		}
	}

