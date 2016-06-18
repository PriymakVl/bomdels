$(document).ready(function() {
	$('#add_draw').click(function(event) {
        event.preventDefault();
        var draw = $('#drawings_form_draw_box input[text="file"]').val;
        if(!draw) alert('Вы не указали файл чертежа');
        else $('#drawings_form_draw').submit();
	});
});