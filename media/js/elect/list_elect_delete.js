$(document).ready(function() {
    $('#delete_list').click(function(event) {  
        event.preventDefault();
        var list_id = $('#form_list input[name="list_id"]').val();
        if(!list_id) {
            alert('Вы не выбрали список');
        }
        else {
            $('#form_list').attr('action', '/elect/deletelist').submit();
        }
    });
});