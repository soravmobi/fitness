<!DOCTYPE html>
<html>
<head>
	<title></title>
<link rel='stylesheet' href='fullcalendar.css' />
<script src='lib/jquery.min.js'></script>
<script src='lib/moment.min.js'></script>
<script src='fullcalendar.js'></script>
<script type="text/javascript">
	$(document).ready(function() {
    $('#calendar').fullCalendar({
    dayClick: function(date) {
        alert('Clicked on: ' + date.format());
        $(this).css('background-color', 'red');
    }
});
});
</script>
</head>
<body>
<div id='calendar'></div>
</body>
</html>
