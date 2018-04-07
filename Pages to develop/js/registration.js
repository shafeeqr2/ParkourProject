
//This function checks each of  the fields in the form for null values.
function checkNulls(form) {
  var message = "";
  var form_valid = true;

  if (form.firstname.value == "") {
      form_valid = false;
      message = "First Name";

  }

  if (form.lastname.value == "") {
    form_valid = false;
    message += " Last Name";

  }

  if (form.email.value == "") {
    form_valid = false;
    message += " Email";

  }


  if (form.password.value == "") {
    form_valid = false;
    message += " Password";

  }


  if (form.password_confirm.value == "") {
    form_valid = false;
    message += " Confirm Password";

  }

  if (!form_valid) {
    window.alert("The following fields are null: " + message);

    return false;
  }

  console.log(form.firstname.value);

  return true;

}


//Ensure that the email provided is valid .i.e. it as an @, characters before the @ and after the @.
function checkEmailValidity(form) {

  if (!(/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/.test(form.email.value))) {
    // e is not an email address
    window.alert("The email is invalid");
    return false;
  }

  return true;

}

//Ensure password and confirm password fields match.
function ensurePasswordsMatch(form) {

  if (form.password.value != form.password_confirm.value) {
    window.alert("Paswords do not match");
    return false;
  }

  return true;

}

//Ensure that the user agrees to the terms and conditions.
function checkAgreement(form) {

  if (!form.checkbox.checked) {
    window.alert("You must agree to the terms and conditions.");
    return false;
  }

  return true;

}

//The validate function runs all the checks above one by one. Should any of the checks fail, an alert pops up informing what the error is.

function validate(form) {

  if (!checkNulls(form)) {
    return false;
  }

  if (!checkEmailValidity(form)) {
    return false;
  }

  if (!ensurePasswordsMatch(form)) {
    return false;
  }

  if (!checkAgreement(form)) {
      return false;
  }

  return true;

}
