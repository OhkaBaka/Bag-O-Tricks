// More notes than anything else
// I figured it might be revealing to git this little monster step by step so the whole world can see my process.
// ...having typed that now I believe that might be the worst idea ever.

// 01/22/2015 - I built a little script that lets you embed an html generated "1up" the scrolls off the screen every

function partikles( profileIn ){


particleProfile : {
	// [d] indicates the variable can have a decay calculation applied to it
	// [v] indicates the variable can have a variance calculation applied to it
	// [g] generated value not manipulable by user

	name: 'Campfire with Smoke',		// Human readable name... will be added as machine name replacing upper case to lower, and replacing spaces with underscore
	machineName: 'campfire_with_smoke',	// [g]

	emitterAge: 0,						// [g] 
	emitterLifespan: 0,					// Emitter lifespan, after interval, spawns stop, after spawning stops and particles decay, emitter unloads
	emitterChildren: 40,				// Maximum particles for this emitter
	emitterSpawnrate: 3,				// [v] particles generated per cycle
	emitterAttachment: 'atCursor'		// string 'atCursor' (cursor current position), string 'toCursor' (follows cursor), array [x,y,attachment] (attaches to point by attachment, "document" == scrollable, "window" == "fixed")

	// Particle values are attached to each particle at creation (with variance applied, when applicable)
	decay: 50,							// [v] number of cycles before decay
	width: 9,height: 9,					// [dv] particle size, independent of structure complexity (a 5x5 particle structure can be scaled down to 3x3, up to 10x10, etc)
	border: true,						// simple border to create color 0 border, around the pixels in each particle

	colorProfile:
		[ '#000000', '#AAAAAA', '#FFFFFF'] ] // color table style, shapeProfile can refer to these colors as 0, 1, and 2
		[ [1,1,1], [255,255,255] ] // random color range style, color generated will be within the range of colors in the set the example would produce any color

	shapeProfile: [ [ 0, 1, 2 ], [1, 2, 2], [2, 1, 0] ],  // columns and rows referring to colors listed in the colorProfile variable, or, for monochromatic particles, true/false for on and off



	hSpeed: 1,
	ball: 0,
	vSpeed: -1,
	vSpeedVariance: 1,
	color: ['#000000', '#FFFFFF', '#FFFFFF'], opacity: [20, 20, 0], shape: [ [ 0, 1, 0 ], [1, 1, 1], [1, 1, 1], [0, 1, 0] ]

	//  Variants are +/- their base values, based on percentage.
	//    eg. a base value of 20 with a variant of .5 can produce a result of 10-30, values more than 100% are considered 100%
	decayVariance: 1,					// variation on length of decay, attached to particle at creation
	birthVariance: .5,					// variation on births per cycle


},