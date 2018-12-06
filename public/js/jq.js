$(document).ready(function() { /* code here */
  $(function() {
      $('#forming').on('change', function() {
    if (this.value == "Code") {
      $("#hiddenTag").show();
      $("#imageTag").show();
      $("#hiddenValue").prop('required',true);
    }else {
      $('#hiddenValue').val("");
      $("#hiddenTag").hide();
      $("#imageTag").hide();
        $("#hiddenValue").prop('required',false);
    }
      });
  });

  $("#hiddenTag").hide();
  $("#imageTag").hide();

});
