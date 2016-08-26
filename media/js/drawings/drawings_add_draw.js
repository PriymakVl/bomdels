$(document).ready(function() {
	$('#add_draw').click(function(event) {
        event.preventDefault();
        var filename = $('#drawings_form_draw_box [name="file"]').val();
        var load = $('#drawings_form_draw_box [name="draw"]').val();
        var type = $('#drawings_form_draw_box [name="type"').val();
 
        if (!filename && !load) alert('Укажите или выберите файл чертежа');
        else if (filename && load) alert('При загрузке файла не нужно указывать его название');
        else if (!type) alert('Вы не выбрали кто сделал чертеж');
        else if (type == 'draft' && !load) alert('Выберите файл для загрузки');
        else $('#drawings_form_draw').submit();
	});
    
});