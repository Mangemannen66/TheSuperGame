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
 * Using DBObjectSaver to automatically "track" a variable
 *
 *
 * PLEASE NOTE THAT DBObjectSaver WILL ALWAYS DELIVER AN
 * ARRAY EVEN FOR PROPERTIES THAT HAVE NEVER BEEN USED.
 * THE ARRAY IS EITHER EMPTY (HAS NO SAVED DATA) OR NOT EMPTY
 * (HAS SAVED DATA).
 *
 */

// if we have data saved for a $ds property it will automatically
// contain the data in every file thanks to Nodebite's black box.
// we check if there is data by using count()
if (count($ds->example_property) === 0) {
  // if the property is an empty array it has no saved data

  //so we create a brand new piece of data (a class instance in this case)
  $example_player = New Player("Example");

  //and push it to the $ds property we want to store it in BY REFERENCE
  $ds->example_property[] = &$example_player;
} else {
  // if the property is NOT an empty array it HAS saved data
  // meaning that all we have to do is put the data of interest
  // in an "alias" variable, using references (&)
  $example_player = &$ds->example_property[0];
}

// the reason we write in the following manner above is that
// regardless of if we loaded saved data from the database
// or created a brand new piece of data the ORIGINAL can be 
// found in the "pretty variable" ($example_player above).

// we have to do this as PHP does not automatically reference
// originals but rather prefers to create clones as often as 
// possible which can result in our code not working as we 
// expect (we could be working with a clone and not an original).



/**
 * That's it! We are now tracking $example_player throughout 
 * this script. DBObjectSaver will automatically store variable 
 * values to database when a script ends.
 *
 * You can repeat this step as many times as you need depending
 * on how many $ds->properties you are using.
 *
 */



/**
 * But what about when a $ds property needs to be broken down
 * into multiple variables?
 *
 */

//well we could still only use one if-statement
if (count($ds->another_example_property) === 0) {
  // if the property is an empty array it has no saved data

  //so we create a brand new piece of data (a class instance in this case)
  $example_player = New Player("Example");
  //another_example_player starts at level  8 so that we can see 
  //how it affects ability to win a challenge later
  $another_example_player = New Player("AnotherExample");

  //and push it to the $ds property we want to store it in BY REFERENCE
  //this time using an associative array key
  $ds->another_example_property["example_player"] = &$example_player;
  $ds->another_example_property["another_example_player"] = &$another_example_player;
} else {
  // if the property is NOT an empty array it HAS saved data
  // meaning that all we have to do is put the data of interest
  // in an "alias" variable, using references (&)
  $example_player = &$ds->another_example_property["example_player"];
  $another_example_player = &$ds->another_example_property["another_example_player"];
}



/**
 * That's it! We are now tracking $example_player and 
 * $another_example_player throughout this script. 
 * DBObjectSaver will automatically store variable 
 * values to database when a script ends.
 *
 * You can repeat this step as many times as you need depending
 * on how many $ds->properties you are using.
 *
 */