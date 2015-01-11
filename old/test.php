<?php

//include Nodebite black box (contains autoloader)
include_once("nodebite-swiss-army-oop.php");


$challenges = array();
$players = array();
$tools = array();

$challenges[] = new Challenge(
  "Bla bla bla bla. ".
  "Bla bla bla bla.  ".
  "Bla bla bla bla. ",
  array(
    "harmony" => 80,
    "scale" => 70,
    "rhythm" => 10,
    "technique" => 50
  )
);
// Create some players with different profiles
$players[] = new RockPianoPlayer("Jerry");
$players[] = new JazzPianoPlayer("Magnus");
$players[] = new PopPianoPlayer("David");

//create three different tools with different skills


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

/*

$tools[] = New Tool(
  "HarmonyBook",
  array(
    "harmony" => 20,
  )
);


$tools[] = New Tool(
  "ScaleBook",
  array(
    "scale" => 15,
  )
);


$tools[] = New Tool(
  "HanonBook",
  array(
    "technique" => 30,
  )
);

$tools[] = New Tool(
  "Metronome",
  array(
    "rhythm" => 30,
  )
);
*/
//give Player the HanonBook tool and see how it affects his chances to win
//$players[0]->tools[] = $tools[2];


  //give Player a random tool everytime the script runs
  //pick a random tool
  $random_index = rand(0, count($tools)-1);
  $random_tool = $tools[$random_index];
  //and give it to Jerry
  $players[0]->tools[] = $random_tool;



//TEAM


//creating a team consisting of two players (Teams behave as regular players)
$players[] = new Team("The Superteam", $players[0], $players[1]);


// Check the chance for each Player to win the challenge (without any tools)
$winChances = $challenges[0] -> winChances($players);
$testPlayers = array();
foreach($winChances as $chance){
  $testPlayers[$chance["player"]->name] = $chance;
  $testPlayers[$chance["player"]->name]["actualWins"]=0;
}

// Play the challenge 10 000 times just to 
// check that the playChallenge randomizes a winner
// according to our probablilites...
for($i = 0; $i < 10000; $i++){
  $winner = $challenges[0]->playChallenge($players);
  $testPlayers[$winner->name]["actualWins"]++;
}

// If we have programmed everything correctly the
// actualWinPercent should be very close to the
// theoretical winPercent after playing 10 000 times
// Check it out!
foreach($testPlayers as &$player){
  $player["actualWinPercent"] = $player["actualWins"]/100;
}

echo('<pre>');
var_export($testPlayers);
echo('</pre>');


/*
echo("<br>"." ".$players[0]->name." got the ".$players[0]->tools[0]->description." tool!");


  public function __construct($tools){
    $this->description = $tools["description"];
    $this->skills = $tools["skills"];
    */


