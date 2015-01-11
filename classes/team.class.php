<?php

//a team class that behaves the same as a player in code (has same skills)
class Team extends Player {
  //a members array in case we need to track who is in the team
  public $members = array();

  //give team the same skills/strengths as player classes so we don't
  //have to change any existing code (winChances, playChallenge etc)
  public $harmonySkill;
  public $scaleSkill;
  public $rhythmSkill;
  public $techniqueSkill;
  public $tools = array();

  //not using references as no player property values will be affected
  public function __construct($name, $humanPlayer, $computerPlayer) {
    $this->members[] = $humanPlayer;
    $this->members[] = $computerPlayer;

    // sum skill points of team members
    $this->harmonySkill = $humanPlayer->harmonySkill + $computerPlayer->harmonySkill;
    $this->scaleSkill = $humanPlayer->scaleSkill + $computerPlayer->scaleSkill;
    $this->rhythmSkill = $humanPlayer->rhythmSkill + $computerPlayer->rhythmSkill;
    $this->techniqueSkill = $humanPlayer->techniqueSkill + $computerPlayer->techniqueSkill;

    //how to add tools to a team, assuming any player can have tools
    for ($i=0; $i < count($this->members); $i++) { 
      for ($j=0; $j < count($this->members[$i]->tools); $j++) { 
        $this->tools[] = $this->members[$i]->tools[$j];
      }
    }

    //call the parent class __construct   (Player) to set name of team
    parent::__construct($name);
  }
}