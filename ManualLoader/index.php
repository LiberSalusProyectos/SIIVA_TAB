<!DOCTYPE html>
<html>
   <head>
     <title>Load Excel Sheet in Browser using PHPSpreadsheet</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   </head>
   <body>
     <div class="container">
      <br />
      <h3 align="center">Load Excel Sheet in Browser using PHPSpreadsheet</h3>
      <br />
      <div class="table-responsive">
       <span id="message"></span>
          <form method="post" id="load_excel_form" enctype="multipart/form-data">
            <table class="table">
              <tr>
                <td width="25%" align="right">Select Excel File</td>
                <td width="50%"><input type="file" name="select_excel" /></td>
                <td width="25%"><button type="submit" name="load" class="btn btn-primary">Submit</button></td>
              </tr>
            </table>
          </form>
       <br />
          <div id="excel_area"></div>
      </div>
     </div>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  </body>
</html>
<script>
$(document).ready(function(){
  $('#load_excel_form').on('submit', function(event){
    event.preventDefault();

	$('button[name$="load"]').prop("disabled", true);
	// add spinner to button
	$('button[name$="load"]').html(
	  `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
	);

    $.ajax({
      url:"upload.php",
      method:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        $('button[name$="load"]').prop("disabled", false);
        // add spinner to button
        $('button[name$="load"]').html(
          `Submit`
        );
        $('#excel_area').html(data);
        $('table').css('width','100%');
      }
    })
  });
});
</script>