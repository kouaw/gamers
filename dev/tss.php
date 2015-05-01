<html>
<head><script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://responsivevoice.org/responsivevoice/responsivevoice.js"></script>
<script>
$(document).ready(function(){
responsiveVoice.speak($('#text').val(),'French Female');
});
</script>
</head><body>
<textarea id="text" cols="45" rows="3">bonjour!</textarea>
 </body>
 </html>
