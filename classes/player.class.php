<?php

//a Player class
class Player extends Base {
  protected $name;
  protected $success = 50;
  //array to hold tools
  protected $tools = array();
  public function __construct($name){
    $this->name = $name;

    
  }


  /**
   * GETTERS & SETTERS
   *
   */

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