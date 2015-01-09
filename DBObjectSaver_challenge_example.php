<?php



/**
 * include Nodebite black box (contains autoloader)
 *
 */

include_once("nodebite-swiss-army-oop.php");

//create a new instance of the DBObjectSaver class 
//and store it in the $ds variable
$ds = new DBObjectSaver(array(
  "host" => "127.0.0.1",
  "dbname" => "wu14oop2",
  "username" => "root",
  "password" => "mysql",
  "prefix" => "example_prefix"
));




/**
 * Check if players exists, if not exit
 *
 */

//using $ds->another_example_property since we need at least two characters for this example
if (!isset($ds->another_example_property["example_player"]) || !isset($ds->another_example_property["another_example_player"])) {
  echo("Could not find all players needed, please run DBObjectSaver_usage_example.php then try again!");
  exit();
}



/**
 * Using DBObjectSaver to load data from DB
 *
 */

// loading an existing character
$example_player = &$ds->another_example_property["example_player"];
$another_example_player = &$ds->another_example_property["another_example_player"];

//checking if a challenge already exists, assume only one ever exists
if (count($ds->example_property_2) === 0) {
  //assigning challenge requirements by passing an associative array to constructor
  $example_requirements = array(
    "shord" => 10,
    "scale" => 8,
  );

  //create new challenge named "Challenge1"
  $example_challenge = New Challenge("Challenge1", $example_requirements);
  //and start tracking of it by pushing it (via reference!) to $ds->example_property_2
  $ds->example_property_2[] = &$example_challenge;

} else {
  //take in challenge by reference
  $example_challenge = &$ds->example_property_2[0];
}



/**
 * Playing a challenge
 *
 */

//check if a character can perform a challenge
$players_playing = array($example_player, $another_example_player);

//calculate winChances just for fun
$win_chances = $example_challenge->winChances($players_playing);

//now play challenge and get the name of the winner
$winner = $example_challenge->playChallenge($players_playing);




/**
 * Echo out result of challenge check as JSON
 *
 */
echo(json_encode(array("winChances" => $win_chances, "winner" => $winner->name)));
