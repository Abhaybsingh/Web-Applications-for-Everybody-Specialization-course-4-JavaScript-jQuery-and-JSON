<html>
<head>
</head>
<body>
<p>Here is some awesome page content</p>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript">
  function d() {
    this.stuff = "Hello";
    console.log(this.stuff);
    this.func = function() {
      this.stuff = "hi";
    }
  }

  data = new d();
  data.stuff = ".hello"; 
  // console(data.stuff);
  data['stuff'] = "hello";
  console(data['stuff']);
</script>
<script type="text/javascript">
$(document).ready(function(){ 
  // data.stuff = "hello"; 
  // data['stuff'] = "hello";
  // console(data.stuff);
  // console(data['stuff']);
  alert("Hello JQuery World!"); 
  window.console && console.log('Hello JQuery..');
});
</script>
</body>
