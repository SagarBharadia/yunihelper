$(document).ready(function() {
	var today = new Date();
	var day = today.getDay();
	var dd = today.getDate();
	var mm = today.getMonth() + 1; //January is 0!
	var yyyy = today.getFullYear();
	if(dd<10) {
	    dd = '0'+dd;
	} 
	switch(day) {
		case 0:
			day = "Sunday";
			break;
		case 1:
			day = "Monday";
			break;
		case 2:
			day = "Tuesday";
			break;
		case 3:
			day = "Wednesday";
			break;
		case 4:
			day = "Thursday";
			break;
		case 5:
			day = "Friday";
			break;
		case 6:
			day = "Saturday";
			break;
		default:
			day = "N/A";
			break;
	}
	date = dd + '.' + mm + '.' + yyyy;
	time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

	$('#dashboard-day').text(day);
	$('#dashboard-date').text(date);
	$('#dashboard-time').text(time);

	setInterval(function(){ 
		var newDate = new Date();
		var hours = newDate.getHours();
		var minutes = newDate.getMinutes();
		var seconds = newDate.getSeconds();
		if (hours < 10) {hours = "0" + hours;}
		if (minutes < 10) {minutes = "0" + minutes;}
		if (seconds < 10) {seconds = "0" + seconds;}
		time = hours + ":" + minutes + ":" + seconds; 
		$('#dashboard-time').text(time);
	}, 1000);
	
});