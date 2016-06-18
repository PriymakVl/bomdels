$(document).ready(function() {
	$('#save_note').click(function(event) {
        event.preventDefault();
        var draw_id = $(':radio:checked').attr('draw_id');
        var note = $(':radio:checked').attr('note');
        $('#drawings_form_note_box [name="draw_id"').val(draw_id);
        var note_new = $('textarea[name="note"]').val();
        //if do not edit return window
        if(note_new == '') alert('Вы не добавили текст');
        else if(note == note_new) {
            $('#drawings_main_box').show();
            $('#drawings_form_note_box').hide();    
        }
        else $('#drawings_form_note').submit();
	});
});