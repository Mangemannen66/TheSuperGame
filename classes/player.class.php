<?php

class Player extends Base {
  public $name;
  public $success = 50;
  //array to hold tools
  public $tools = array();
  public function __construct($name){
    $this->name = $name; 
  }

  public function pickupRandomTool(&$tools) {
    //take in $tools by reference so that we work with the original
    //$ds->available_tools data and not a silly clone

    if (count($this->tools) < 3) {
      //select a random tool
      $random_tool_index = rand(0, count($tools)-1);
      $random_tool = $tools[$random_tool_index];
      //pick it up
      $this->tools[] = $random_tool;
      //and remove it from $ds->available_tools
      array_splice($tools, $random_tool_index, 1);
    }
  }

  public function loseRandomTool(&$tools) {
    //take in $tools by reference so that we work with the original
    //$ds->available_tools data and not a silly clone

    //if the Character has any tools.
    if (count($this->tools) > 0) {
      //pick a random tool
      $random_tool = rand(0, count($this->tools)-1);

      //lose the tool
      //NOTE: array_splice always returns an array
      $lost_tool = array_splice($this->tools, $random_tool, 1);

      //and return the lost tool to available_tools available to 
      //all players.
      $tools[] = $lost_tool[0];
    }
  }

  public function doChallenge($challenge, $players) {
    //find the winners and return them
    $result = array();
    while (count($players) !== 0) {
      $result[] = $challenge->playChallenge($players);

      //stop this rounds winner from playing again
      $round_winner_index = array_search($result[count($result)-1], $players);
      array_splice($players, $round_winner_index, 1);
    }

    return $result;
  }

  public function doChallengeWithFriend($challenge, &$players) {
    //find the winners and return them
    return $this->doChallenge($challenge, $players);
  }
/*
  public function get_name() {
    return $this->name;
  }
  public function get_success() {
    return $this->success;
  }
  public function get_tools() {
    return $this->tools;
  }
*/
}