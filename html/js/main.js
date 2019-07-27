
function mysqlforms(form_id, success, fail, div_id, message) {
 var form = $("#" + form_id);
 form.submit(function(event) {
   // this stops the form from submitting
   event.preventDefault();

   var formdata = form.serialize();

   $.ajax({
     type: form.attr('method'),
     url: form.attr('action'),
     data: formdata
   }).done(function(response) {
     success(response, form_id, div_id, message);
   }).fail(function(error) {
     fail(error);
   });
 })
}



function onSuccessGeneral(response, form, div_id, message) {
  document.getElementById(form).style.display="none";
  document.getElementById(div_id).innerHTML = message;
  console.log(form);
}



function onFailure(error) {
  console.log(error);
}

// mysqlPageCommentsLoad()

mysqlforms("add_comment_rating", onSuccessGeneral, onFailure, "msg",
"Comment and rating has been submitted.");

mysqlforms("add_location", onSuccessGeneral, onFailure, "msg",
"Location has been added to the the database!");
