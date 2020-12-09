<html>
<head>
</head>
<body>
<p>Change the contents of the text field and then tab away from the field to trigger the change event. Do not use Enter or the form will get submitted.</p>

<!-- a form with a bos and a spinner at the right side of the box -->
<form id="target">
  <input type="text" name="one" value="Hello there" 
    style="vertical-align: middle;"/> 
  <img id="spinner" src="spinner.gif" height="25"
    style="vertical-align: middle; display:none;">
</form>

<hr/>

<div id="result"></div>
<hr/>

<script type="text/javascript" src="jquery.min.js"></script>

<script type="text/javascript">
  // this willl look up to that object and then register event
  // if sme change the text in the box then this function is called
  $('#target').change(function(event) {
    // this will not submit the form
    event.preventDefault();
    // this will display the spinner
    $('#spinner').show();
    //  assign target to the variable form
    var form = $('#target');
    // find will find this text inside the form
    // val() will take the text from that tag we just found
    // rhen stored in the variable text
    var txt = form.find('input[name="one"]').val();
    // writting the message to the console
    window.console && console.log('Sending POST');
    // $ is an object and post is a method in that obj
    // now the first parameter is the sever based script tp print the spinner on the page
    // now the second parameter because it is a post request so we will send the val
    // now the 3 partameter is the code which we are going to run
    $.post( 'autoecho.php', { 'val': txt },
      // data is the output of the autoecho script
      function( data ) {
          window.console && console.log(data);
          // it is going to remove the data and append the data inside
          $('#result').empty().append(data);
          // hide the spinner
          $('#spinner').hide();
      }
      // post return an object
      // if any error occur then it will not execute the function(data)
      // it will directlty comes to this error(function)
    ).error( function() { 
      //it chbages the backgrounfcolor to the red 
      $('#target').css('background-color', 'red');
      alert("Dang!");
	    });
  });
</script>
</body>