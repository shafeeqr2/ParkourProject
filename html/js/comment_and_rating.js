

//The validate function runs all the checks above one by one. Should any of the checks fail, an alert pops up informing what the error is.


//This function checks each of  the fields in the form for null values.
function checkNulls(form) {
  var message = "";
  var form_valid = true;

  if (form.comment.value == "") {
      form_valid = false;
      message = "Comment";

  }

  if (form.rating.value == 0) {
    form_valid = false;
    message += " Rating";

  }

  if (!form_valid) {
    window.alert("The following fields are null: " + message);

    return false;
  }


  return true;

}

function validate(form) {

  if (!checkNulls(form)) {
    return false;
  }

  return true;

}
