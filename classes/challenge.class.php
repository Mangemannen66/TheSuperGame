<?php


// A challenge class
class Challenge extends player {
  public $description;
  public $skills;
  
  public function __construct($description,$skills){
    $this->description = $description;
    $this->skills = $skills;

  }

  // In howGoodAMatch() we want to return how well
  // a player matches this challenge as a float number 
  // between 0 - 1
  public function howGoodAMatch($player){
    //total points a player has
    $sum= 0;
    //total points possible for this challenge
    $max = 0;

    //calculate how good of a match a player is to this challenge
    foreach($this->skills as $skill => $points){
      //by checking how many skillpoints the challenge requires
      $needed = $points;
      //and by checking how many skillpoints a player has
      $has = $player->{$skill.'Skill'}; //chordSkill

      //check if a player has any tools
      if (count($player->tools) > 0) {
        //if they do, go through them
        for ($i = 0; $i < count($player->tools); $i++) {
          //and for each skill the tool has
          foreach ($player->tools[$i]->skills as $toolSkill => $value) {
            //if a toolSkill matches the skill we are currently calculating
            if ($toolSkill == $skill) {
              //add the toolSkill points 
              $has += $value;
            }
          }
        } 
      }

      //if a player has more points than needed, only count the points needed (to preserve our percentage)
      //(usimg ternary)
      //else count the skillpoints a player has 
      $sum += $has > $needed ? $needed : $has;
      $max += $needed;

      //echo ($sum);
      //echo ($max);
      //echo ("<br>".$needed);
    }

    //return the percentage of skill points they have
    return $sum/$max;
  }

  // This calculates the chances to win the challenge
  // as a percentage for each player
  public function winChances($players){
    $matches = array();
    //count is used to create a range of win intervals for all players
    $count = 0;
    //calculate chance to win using howGoodAMatch()
    foreach($players as $player){
      $howGoodAMatch = $this->howGoodAMatch($player);
      //and store result in matches
      $matches[] = array(
        "player" => $player,
        "howGoodAMatch" => $howGoodAMatch,
      );
      //increase count to create an interval
      $count += $howGoodAMatch;
    }
    //also create a percentage to be nice (better to count with)
    foreach($matches as &$match){
      $match["winChancePercent"] = round(100*($match["howGoodAMatch"]/$count));
    }
    //return win chances
    return $matches;
  }

  // Randomize a winner according to win chances for each player
  public function playChallenge($players){
    //get chances to win for each player
    $matches = $this->winChances($players);
    //once again we are using intervals to check for a winner
    $count = 0;
    //pick a random number (between 0 and 100 since we are using percent)
    $rand = rand(0,100);

    //then check which player interval contains the random number
    foreach($matches as $match){
      if(
        $rand >= $count && 
        $rand <= $match["winChancePercent"] + $count
      ){
        //if a players interval contains the random number
        // we have a winner, end function using return
        return $match["player"];
      }
      //if this player was not a winner, increase interval and try again...
      $count += $match["winChancePercent"];
    }
  }
}

/*
$challenges = array();
$players = array();
$tools = array();

$challenges[] = new Challenge(
  "Bla bla bla bla. ".
  "Bla bla bla bla.  ".
  "Bla bla bla bla. ",
  array(
    "chord" => 80,
    "scale" => 70,
    "rhythm" => 10,
    "technique" => 50
  )
);



// Try out our brilliant code below


// Create some players with different profiles
$players[] = new RockPianoplayer("Jerry");
$players[] = new JazzPianoplayer("Magnus");
$players[] = new PopPianoplayer("David");

//create three different tools with different skills
$tools[] = New Tool(
  "HarmonyBook",
  array(
    "chord" => 20,
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


