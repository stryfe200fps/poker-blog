
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>


<input name="user_timezone" id="user_timezone" type ="hidden" value="timezones" />

<script>


$(document).ready(function () {

  var timezone_offset_minutes = new Date().getTimezoneOffset();
timezone_offset_minutes = timezone_offset_minutes == 0 ? 0 : -timezone_offset_minutes;

$('#user_timezone').val(timezone_offset_minutes)

})


</script>