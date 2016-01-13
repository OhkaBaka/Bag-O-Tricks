<?php
	//header("Content-type: text/plain");
	header("x-clacks-overhead: GNU Terry Pratchett" );

	// PHP Adventure
	// An experiment in PHP OOP, potentially to feed GEngHIS, but more imediately, to make a nifty text adventure.
	
	//LEARN THE LINGO... learning OOP in a void was not nescessarily the best for my interaction with other OOP speakers.
	//Abstract class: Framework that says "This is what you need to do, but I'm not going to do it for you"
	//Overload means "Dynamically Alter a method" in PHP OOP... which doesn't really fit the monicker... I'm not sure what real overloading is called in OOP
	//Interfaces are NOT dumb, just not "functional" code. An abstract is a parent, just like a regular class, only flexible enough to allow individual implementations.  An interface is a set of function declarations, that can be ADDED to a definition.
	//Reusable code: An interface declares, but doesn't define, but that doesn't mean it HAS to be in the class definition directly.
	
	interface aMove{
		public function aGo();
	}
	
	class aObject{
		function __construct( $desc="a thing of some kind", $name="object" ) {
			$this->description = $desc;
			$this->name = $name;
			$this->mname = $mname;
		}
		function lookAt(){
			echo "It is " . $this->description . "\n";
		}
	}
	
	class aContainer extends aObject{
		public function __construct( $desc = "A Container", $name="container", $contains = Array() ) {
		   parent::__construct($desc, $name);
		   $this->contains = $contains;
		}
		public function lookIn(){
			echo "The contents of this " . $this->name . ".\n";
		}
	}
	
	class aLocation extends aObject{
		public function __construct( $name="location", $desc="A Location", $passages=Array(0,0,0,0,0,0) ) {
		   parent::__construct($desc, $name);
		   $this->passages = $passages;
		}
		public function go( $dir ){
			if( $dir == "N" ) $passVar = 0;
			if( $dir == "E" ) $passVar = 1;
			if( $dir == "S" ) $passVar = 2;
			if( $dir == "W" ) $passVar = 3;
			if( $dir == "U" ) $passVar = 4;
			if( $dir == "D" ) $passVar = 5;
			if( $this->passages[$passVar] == 0 ){
				if( $this->passages == Array(0,0,0,0,0,0)){
					echo "There is no escape from " . $this->name . ".\n";
				} else {	
					echo "There is not a passage in that direction.\n";
				}
			} else {
				$attemptToPass = $this->passages[$passVar]->isPassable();
				if( $attemptToPass == TRUE ){
					echo "You go through the " . $this->passages[$passVar]->name . ".\n";
				} else {
					echo "You can not pass through that " . $this->passages[$passVar]->name . ".\n";
				}
			}
		}
		public function lookAt(){
			parent::lookAt();
			$directions=Array('to the north','to the east','to the south','to the west','above you,','beneath you');
			for( $dir=0; $dir<=5; $dir++ ){
				if( $this->passages[$dir] != 0 ){
					echo "There is " . $this->passages[$dir]->description . " " . $directions[$dir] . ".\n";
				}
			}
		}
	}
	
	class aPassage extends aObject{
		public function __construct( $name="passageway", $desc="a passageway", $dest = 0, $view=TRUE, $pass=TRUE ) {
		   parent::__construct($desc, $name);
			$this->destination = $dest;
			$this->viewable = (bool)$view;
			$this->passable = (bool)$pass;
		}
		public function lookThrough()
		{
			if( $this->viewable ){
				echo "You see " . $this->destination->name . " beyond this " . $this->name . ".\n";
			} else {
				echo "You cannot see through this " . $this->name . ".\n";
			}
		}
		public function isPassable(){
			return $this->passable;
		}
	}
	
	class aWindow extends aPassage{
		public function __construct( $name="window", $desc="a window", $dest = 0 ) {
			parent::__construct( $name, $desc, $dest, true, false);
		}
	}
	
	// define each location objects first, then containers
	$location[0] = new aLocation( "The Null Void", "a place that can not be described, even as it can be named.", array( 0, 0, 0, 0, 0, 0 ) );
	
	$window[] = new aWindow( "small window", "a small window opening into the next cell", $location[2] );
	$passage[] = new aPassage( "stone passageway", "a stone passageway that leads into the next cell", $location[2], true, true );
	$location[1] = new aLocation( "The Begining", "the place that is the begining.", array( $passage[0], $window[0], 0, 0, 0, 0 ) );
	
	$window[] = new aWindow( "small window", "a small window opening into the next cell", $location[0] );
	$window[] = new aWindow( "small window", "a small window opening into the next cell", $location[1] );
	$passage[] = new aPassage( "stone passageway", "a stone passageway that leads into the next cell", $location[0], true, true );
	$passage[] = new aPassage( "stone passageway", "a stone passageway that leads into the next cell", $location[1], true, true );
	$location[2] = new aLocation( "A Room", "an ordinary room.", array( $passage[1], $window[1], $passage[2], $window[2], 0, 0 ) );


	echo "<br/><li> LOOK</li>";
	$location[1]->lookAt();
	echo "<br/><li> GO SOUTH</li>";
	$location[1]->go("S");
	echo "<br/><li>GO EAST</li>";
	$location[1]->go("E");
	echo "<br/><li> LOOK WINDOW</li>";
	$window[0]->lookAt();
	echo "<br/><li> LOOK THROUGH WINDOW</li>";
	$window[0]->lookThrough();
	echo "<br/><li> LOOK DOOR</li>";
	$passage[0]->lookAt();
	echo "<br/><li> LOOK THROUGH DOOR</li>";
	$passage[0]->lookThrough();
	echo "<br/><li> GO NORTH</li>";
	$location[0]->go("N");
	echo "<br/><li> LOOK\n";
	$location[0]->lookAt();
?>
