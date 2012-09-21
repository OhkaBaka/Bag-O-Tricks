<?php

$haikus = Array(
	Array('date'=>'24 Aug', 'haiku'=>'There are four of us / Her, You, and Me versus Them / the odds are with us', 'author'=>'OhkaBaka'),
	Array('date'=>'23 Aug', 'haiku'=>'rockabilly zombie / plays a bass line on his bones / back beat in his spine', 'author'=>'OhkaBaka'),
	Array('date'=>'23 Aug', 'haiku'=>'touch my girl again / and i will rip off your arms / and beat you with them', 'author'=>'OhkaBaka'),
	Array('date'=>'22 Aug', 'haiku'=>'his new headphones / drown out my screaming victims / and my shambling steps', 'author'=>'OhkaBaka'),
	Array('date'=>'20 Aug', 'haiku'=>'Three phases of death / first soul, then mind, body is last / two down one to go', 'author'=>'OhkaBaka'),
	Array('date'=>'19 Aug', 'haiku'=>'food court lunch menu / I choose burger, you choose greek / I will avenge him', 'author'=>'OhkaBaka'),
	Array('date'=>'18 Aug', 'haiku'=>'screen door bangs loudly / harbinger of visitors / houseguests from the grave', 'author'=>'OhkaBaka'),
	Array('date'=>'15 Aug', 'haiku'=>'Tesla was zap man / Matt Inman was named to eat / zombie approves this', 'author'=>'OhkaBaka'),
	Array('date'=>'31 Jul', 'haiku'=>'I am exhausted / maybe if I just lie still / they won\'t see that I...', 'author'=>'OhkaBaka'),
	Array('date'=>'29 Jul', 'haiku'=>'sip morning coffee / the dead drink from mud puddles / most alike at dawn', 'author'=>'OhkaBaka'),
	Array('date'=>'28 Jul', 'haiku'=>'not my wife, monster! / I pull the trigger two times / not my wife. monster.', 'author'=>'OhkaBaka'),
	Array('date'=>'6 Jul', 'haiku'=>'chevrolet bumper / ricochet cacophony / detroit zombie plow', 'author'=>'OhkaBaka'),
	Array('date'=>'3 Jul', 'haiku'=>'it bows and unsheathes / muscle remembers the path / hungry eyes do not', 'author'=>'OhkaBaka'),
	Array('date'=>'2 Jul', 'haiku'=>'your gaze is weary / pleading eyes, awake too long / i will help you rest', 'author'=>'OhkaBaka'),
	Array('date'=>'28 Jun', 'haiku'=>'swaying in the wind / at dawn they stand like willow / waiting for my blade', 'author'=>'OhkaBaka'),
	Array('date'=>'22 Jun', 'haiku'=>'a heat wave descends / hard to find safe swimming pools / zombie water traps', 'author'=>'OhkaBaka'),
	Array('date'=>'20 Jun', 'haiku'=>'zombie heed warning / I suffer not apathy / all you say is "meh"', 'author'=>'OhkaBaka'),
	Array('date'=>'15 Jun', 'haiku'=>'goth girl or undead / pale skin, dark eyes, crooked smile / I make bad choices', 'author'=>'OhkaBaka'),
	Array('date'=>'15 Jun', 'haiku'=>'unsteady stumbles / the silhouette in my scope / hope he wasn\'t drunk', 'author'=>'OhkaBaka'),
	Array('date'=>'15 Jun', 'haiku'=>'horizon zombie / we\'ll meet between origins / one will travel on', 'author'=>'OhkaBaka')
) ;


$vistaLocations = Array( "lions"=>"Lion's Arch", "caledon"=>"Caledon Forest", "grove"=>"The Grove" );

$screenshots = Array();
if ($handle = opendir('images')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != ".." && $entry != 'thumbs' ) {
			switch ( substr( $entry,0,1 ) ) {
				case "w":
					$thisShot = Array(
						'image'=>$entry,
						'type'=>'caption',
						'location'=>ucwords( str_replace( '_', ' ', str_replace( '__', ': ', preg_replace( '/.\-([^\-]*)\-.*/i','\1', $entry ) ) ) ),
						'subject'=>ucwords( str_replace( '_', ' ', preg_replace( '/.\-[^\-]*\-([^\-]*)\-.*/i','\1', $entry ) ) )
					);
					break;
				case "v":
					$thisShot = Array(
						'image'=>$entry,
						'type'=>'vista',
						'location'=>$vistaLocations[ preg_replace( '/.\-([^\-]*)\-.*/i','\1', $entry ) ],
						'subject'=>''
					);
					break;
				case "c":
					$thisShot = Array(
						'image'=>$entry,
						'type'=>'character',
						'location'=>'',
						'subject'=>ucwords( str_replace( '_', ' ', preg_replace( '/.\-([^\-]*)\-.*/i','\1', $entry ) ) )
					);
					break;
				case "l":
					$thisShot = Array(
						'image'=>$entry,
						'type'=>'snapshot',
						'location'=>ucwords( str_replace( '_', ' ', str_replace( '__', ': ', preg_replace( '/.\-([^\-]*)\-.*/i','\1', $entry ) ) ) ),
						'subject'=>ucwords( str_replace( '_', ' ', preg_replace( '/.\-[^\-]*\-([^\-]*)\-.*/i','\1', $entry ) ) )
					);
					break;
			}
			array_push( $screenshots, $thisShot );
		}

    }
    closedir($handle);
}

if( isset($_GET["init"]) && $_GET["init"]==true ) $feedCount=5;
else if( rand(1,3)==3 ) $feedCount=1;
else $feedCount=0;

$responseJSON = "";

for( $ix=1; $ix<=$feedCount; $ix++ ){
	$screenshot = $screenshots[ rand( 1 , count( $screenshots ) ) ];
	$responseJSON .= '{ "timestamp": "' . date('Y-m-d H:i:s') . '", "image":"' . $screenshot["image"] . '", "type":"' . $screenshot["type"] . '", "location":"' . $screenshot["location"] . '", "subject":"' . $screenshot["subject"] . '" }';
	if( $ix < $feedCount ) $responseJSON .= ",\r\n";
}

echo "[ " . $responseJSON . " ]";