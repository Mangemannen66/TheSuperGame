<?php

//a tool class
class Tool extends Player {
  public $description;
  public $skills;



  public function __construct($description,$skills){
    $this->description = $description;
    $this->skills = $skills;
  }
}