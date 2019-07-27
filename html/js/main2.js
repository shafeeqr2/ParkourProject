
function mysqlRequests(form_id, success, fail) {
 var $form = $("#" + form_id);
 $form.submit(function(event) {
   // this stops the form from submitting
   event.preventDefault();

   var formdata = $form.serialize();

   $.ajax({
     type: $form.attr('method'),
     url: $form.attr('action'),
     data: formdata
   }).done(function(response) {
     success(response, $form);
   }).fail(function(error) {
     fail(error, $form);
   });
 })
}

function onSuccess(success) {
  console.log(success);
}

function onFailure(error) {
  console.log(error);
}


mysqlRequests("add_comment", (response, form) => {
  form.children()[0].value = "";
  console.log(response);
}, onFailure);
