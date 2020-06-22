function openModal() {
	$('.modal').fadeIn('fast');
}
function closeModal() {
	$('.modal').fadeOut('fast');
}

$(document).ready(function() {

});

$(document).keyup(function(e) {
    if (e.keyCode == 27) { // escape key maps to keycode `27`
    	closeModal();  
    }
});