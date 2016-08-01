$(document).ready(function() {
	$('#show_elements_list').click(function() {
	   var list_id = $('#edit_list_box :radio:checked').attr('list_id');
       if(!list_id) {
            alert('Вы не выбрали список');
            return;
       }
       else location.href = '/elect/changelist?list_id=' + list_id;
	});
});