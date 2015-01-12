//DOM ready
$(function() {
  


  /**
   * AJAX EXAMPLE
   *
   */

  $.ajax({
    url: "start_game.php",
    dataType: "json",
    data: {
      something: 1
    },
    success: function(data) {
      console.log("AJAX EXAMPLE SUCCESS, data: ", data);
    },
    error: function(data) {
      console.log("AJAX EXAMPLE ERROR, data.responseText: ", data.responseText);
    }
  });



  /**
   * example submit handler for the .aForm form in index.html
   *
   */
   
  $(".aForm").submit(function() {
    //since all our form input fields have id's we'll use those as object keys
    var collectedFormInfo = {};
    //select all input fields that are not type=submit and not unchecked type=radio and loop through them using jQuery .each()
    $(this).find("input").not("input[type='submit'], input[type='radio']:not(:checked)").each(function() {
      //code in here runs for each iteration of the jQuery loop
      //get input field id
      var fieldId = $(this).attr("id");
      //get input field value
      var fieldVal = $(this).val();

      //use them to store data in our object
      collectedFormInfo[fieldId] = fieldVal;
    });

    //then console.log() the object when it's complete!
    console.log("collectedFormInfo: ", collectedFormInfo);

    //always return false to prevent page reload
    return false;
  });


});