<?php


//Nodebite black box
include_once("nodebite-swiss-army-oop.php");

//create a new instance of the DBObjectSaver class 
//and store it in the $ds variable
$ds = new DBObjectSaver(array(
  "host" => "127.0.0.1",
  "dbname" => "wu14oop2",
  "username" => "root",
  "password" => "mysql",
  "prefix" => "piano_battle",
));

//destroy old game data
unset($ds->players);
unset($ds->have_won);
unset($ds->have_lost);
unset($ds->challenges);
unset($ds->available_tools);


//these should be delivered with AJAX
$player_name = "Magnus Danielsson";
$player_class = "RockPianoPlayer";



/**
 * Create all three players
 *
 * "3 spelare ska skapas. Människan får välja namn och spelartyp."
 *
 */

//push human player first to players property
$ds->players[] = New $player_class($player_name, $ds);

//make random virtualplayer (can also be done with a while loop)
$available_classes = array("RockPianoPlayer", "JazzPianoPlayer", "PopPianoPlayer");
for ($i=0; $i < count($available_classes); $i++) { 
  if ($available_classes[$i] != $player_class) {
    $ds->players[] = New $available_classes[$i]("VirtualPlayer".$i, $ds);
  }
}



/**
 * Create all nine tools randomly
 *
 * "9 föremål skapas, slumpvis. Max två av samma slag."
 *
 * "Alla föremål är av samma klass och får olika styrkor genom 
 * att dessa matas in som en associativ array till konstruktorn."
 *
 */

//there are five kinds of tools
$tool_properties = array(
  array(
    "description" => "HarmonyBook",
    "skills" => array(
      "harmony" => 20,
    ),
  ),
  array(
    "description" => "ScaleBook",
    "skills" => array(
      "scale" => 30,
    ),
  ),
  array(
    "description" => "HanonBook",
    "skills" => array(
      "technique" => 10,
    ),
  ),
  array(
    "description" => "Metronome",
    "skills" => array(
      "rhythm" => 20,
    ),
  ),
  array(
    "description" => "Tudor",
    "skills" => array(
      "harmony" => 20,
      "rhythm" => 20,
      "technique" => 20,
      "scale" => 20,
    ),
  ),
);

//now lets create a random amount, but never more than two of each
//first a helper function to check how many times an object 
//appears in an array
function occurence_of($value, $array) {
  $count = 0;
  for ($i=0; $i < count($array); $i++) { 
    if ($value === $array[$i]) {
      $count++;
    }
  }
  return $count;
}

//an empty array used to check how many tools have been created
$created_tools = array();

//now create tools randomly!
while(count($ds->available_tools) < 9) {
  $random_tool = $tool_properties[rand(0, count($tool_properties)-1)];
  //if we have created less than two of this particular tool as of yet
  if (occurence_of($random_tool, $created_tools) < 2) {
    //create one more
    $ds->available_tools[] = New Tool($random_tool);
  }
}



/**
 * Create some Challenges
 *
 * "X utmaningar skapas."
 *
 * "Alla utmaningar är av samma klass och får olika krav/styrkor genom 
 * att dessa matas in som en associativ array till konstruktorn."
 *
 */

$ds->challenges[] = new Challenge(
  "Rock'n Roll is king. ".
  "You will play the tune Rock'n roll is king. ".
  "Best peformance wins.",
  array(
    "harmony" => 0,
    "scale" => 30,
    "rhythm" => 70,
    "technique" => 50
  )
);

$ds->challenges[] = new Challenge(
  "Stella by starlite. ".
  "This is a classic jazzstandard. ".
  "You play it and make a solo that will stun us - that can can be the winning concept.",
  array(
    "harmony" => 60,
    "scale" => 60,
    "rhythm" => 40,
    "technique" => 50
  )
);

$ds->challenges[] = new Challenge(
  "harmony a pork roast in the oven. ".
  "rhythm potatoes to go with it. ".
  "Serve some fine cheeses for technique.",
  array(
    "harmony" => 80,
    "scale" => 0,
    "rhythm" => 20,
    "technique" => 10
  )
);

$ds->challenges[] = new Challenge(
  "Make a lovely mushroom soup as a started. ".
  "harmony salmon with some onions. ".
  "Make a pudding for technique.",
  array(
    "harmony" => 50,
    "scale" => 0,
    "rhythm" => 60,
    "technique" => 80
  )
);

$ds->challenges[] = new Challenge(
  "The queen comes over for lunch. ".
  "Make her the best lunch she's ever tasted.",
  array(
    "harmony" => 80,
    "scale" => 80,
    "rhythm" => 80,
    "technique" => 0
  )
);


//and echo out the human player
echo(json_encode($ds->players[0]));