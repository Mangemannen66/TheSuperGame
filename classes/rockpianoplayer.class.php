<?php

class RockPianoPlayer extends Player {

  public $chordSkill = 50;
  public $scaleSkill = 30;
  public $rhythmSkill = 90;
  public $techniqueSkill = 30;
  public $name;
  public $success = 50;
  public $tools = array();

   public function __construct($name){
    $this->name = $name;
  }

  public function get_chordSkill() {
    return $this->chordSkill;
  }

  public function get_scaleSkill() {
    return $this->scaleSkill;
  }

  public function get_rhythmSkill() {
    return $this->rhythmSkill;
  }

  public function get_techniqueSkill() {
    return $this->techniqueSkill;
  }

  public function get_name() {
    return $this->name;
  }

  public function get_success() {
    return $this->success;
  }

  public function get_tools() {
    return $this->tools;
  }

}